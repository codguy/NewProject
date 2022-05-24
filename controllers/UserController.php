<?php
namespace app\controllers;

use app\models\Users;
use app\models\search\Users as UsersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\models\Notification;
use app\models\SocialLink;
use app\models\Follow;
use app\models\Skill;
use yii\filters\AccessControl;
use app\components\AcessRuules;
use app\models\Feed;
use app\models\Like;

/**
 * UserController implements the CRUD actions for Users model.
 */
class UserController extends Controller
{

    /**
     *
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => [
                        'post'
                    ]
                ]
            ],
            /* 'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'ruleConfig' => [
                    'class' => \app\models\AcessRuules::className()
                ],
                'only' => [
                    'index',
                    'create',
                    'update',
                    'view'
                ],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => [
                            Users::isAdmin(),
                            Users::isManager(),
                            Users::isTrainer()
                        ]
                    ]
                ]
            ] */
        ];
    }

    /**
     * Lists all Users models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Displays a single Users model.
     *
     * @param int $id
     *            ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id)
        ]);
    }

    /**
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Users();
        $obj = rand(100, 999);
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->created_on = date('Y-m-d H:i:s');
                $model->updated_on = date('Y-m-d H:i:s');
                $model->created_by_id = ! empty(\Yii::$app->user->id) ? \Yii::$app->user->id : Users::ROLE_ADMIN;
                $model->state_id = Users::STATE_ACTIVE;
                $model->authKey = 'test' . $obj;
                $model->accessToken = $obj . '-token';
                if(UploadedFile::getInstance($model, 'profile_picture') != null){
                    $model->profile_picture = UploadedFile::getInstance($model, 'profile_picture');
                    $model->profile_picture = $model->upload();
                }
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($model->save()) {
                        $title = 'New ' . $model->getRole($model->roll_id);
                        $type = Notification::TYPE_NEW;
                        $users = Users::find()->where([
                            '<=',
                            'roll_id',
                            Users::ROLE_TRAINER
                        ]);
                        foreach ($users->each() as $user) {
                            Notification::createNofication($title, $type, $model, $user->id, 'user');
                        }
                        Notification::createNofication('Welcome', Notification::TYPE_SUCCESS, $model, $model->id, 'user');
                        $this->redirect([
                            'view',
                            'id' => $model->id
                        ]);
                    }else{
                        print_r($model->getErrors());
                    }
                    $transaction->commit();
                } catch (\Exception $e) {
                    $transaction->rollBack();
                    print $e;
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }

    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param int $id
     *            ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $image = $model->profile_picture;
        if ($this->request->isPost && $model->load($this->request->post())) {
            if(UploadedFile::getInstance($model, 'profile_picture') != null){
                $model->profile_picture = UploadedFile::getInstance($model, 'profile_picture');
                $model->profile_picture = $model->upload();
            }
            else{
                $model->profile_picture = $image;
            }
            $model->updated_on = date('Y-m-d H:i:s');
            if ($model->save(false)) {
                $title = 'Updated : ' . $model->username;
                $type = Notification::TYPE_UPDATED;
                Notification::createNofication($title, $type, $model, $model->id, 'user');
                return $this->redirect([
                    'view',
                    'id' => $model->id
                ]);
            }
        }

        return $this->render('update', [
            'model' => $model
        ]);
    }

    /**
     * Deletes an existing Users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param int $id
     *            ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect([
            'index'
        ]);
    }

    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param int $id
     *            ID
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Users::findOne([
            'id' => $id
        ])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(\Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionAddSocial($user_id = false)
    {
        $newmodel = new SocialLink();
        $post = $this->request->post();
        if (! empty($post)) {
            foreach ($post as $key => $value) {
                if (! empty($value)) {
                    $prev = SocialLink::findOne([
                        'user_id' => $user_id,
                        'platform' => $key
                    ]);
                    if (! empty($prev)) {
                        $prev->link = $value;
                        $prev->updated_on = date('Y-m-d H:i:s');
                        $prev->updateAttributes([
                            'link',
                            'updated_on'
                        ]);
                        $title = 'Updated social link';
                        $type = Notification::TYPE_UPDATED;
                        Notification::createNofication($title, $type, $prev, $user_id, 'user-plus');
                        continue;
                    }
                    $model = new SocialLink();
                    $model->user_id = $user_id;
                    $model->platform = $key;
                    $model->link = $value;
                    $model->created_on = date('Y-m-d H:i:s');
                    $model->updated_on = date('Y-m-d H:i:s');
                    $transaction = \Yii::$app->db->beginTransaction();
                    try {
                        if ($model->save(false)) {
                            $title = 'Updated social link';
                            $type = Notification::TYPE_UPDATED;
                            Notification::createNofication($title, $type, $model, $user_id, 'share-alt');
                        }
                        $transaction->commit();
                    } catch (\Exception $e) {
                        $transaction->rollBack();
                        print $e;
                    }
                }
            }
            return $this->redirect([
                'user/view',
                'id' => $user_id
            ]);
        }

        return $this->render('add_social', [
            'model' => $newmodel,
            'user_id' => $user_id
        ]);
    }

    public function actionFollow()
    {
        $model = new Follow();
        $post = $this->request->post();
        $user_model = $post['model'];
        $user = $user_model::findOne([
            $post['id']
        ]);
        if (! empty($post)) {
            $prev = Follow::findOne([
                'model_id' => $post['id'],
                'model' => $post['model'],
                'user_id' => \Yii::$app->user->identity->id
            ]);
            if (! empty($prev)) {
                $prev->delete();
            } else {
                $model->user_id = \Yii::$app->user->identity->id;
                $model->model = $post['model'];
                $model->model_id = $post['id'];
                $model->created_on = date('Y-m-d H:i:s');
                $model->updated_on = date('Y-m-d H:i:s');
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($model->save(false)) {
                        $title = 'Followed by ' . \Yii::$app->user->identity->username;
                        $type = Notification::TYPE_NEW;
                        $notification = new Notification();
                        $notification->title = $title;
                        $notification->type_id = $type;
                        $notification->model_id = $user->id;
                        $notification->to_user_id = $user->id;
                        $notification->icon = 'users';
                        $notification->state_id = Notification::STATE_UNREAD;
                        $notification->model = get_class($model);
                        $notification->created_on = date('Y-m-d H:i:s');
                        $notification->created_by_id = ! empty(\Yii::$app->user->id) ? \Yii::$app->user->id : Users::ROLE_ADMIN;
                        $notification->save(false);
                    }
                    $transaction->commit();
                } catch (\Exception $e) {
                    $transaction->rollBack();
                    print $e;
                }
            }
        }
        $count = Follow::find()->where([
            'model_id' => $post['id'],
            'model' => $post['model']
        ])->count();
        return $count;
    }

    public function actionAddSkill()
    {
        $model = new Skill();
        $post = $this->request->post();
        if (! empty($post)) {
            $model->level = $post['level'];
            $model->skill = $post['skill'];
            $model->model = $post['model'];
            $model->model_id = $post['id'];
            $model->created_on = date('Y-m-d H:i:s');
            $model->updated_on = date('Y-m-d H:i:s');
            $model->save();
        }
        $result = Users::getSkillBadge($model->skill, $model->level);
        // print_r($result);die()
        return $result;
    }

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }
    
    public function actionCreateFeed(){
        $model = new Feed();
        $post = $this->request->post();
        if (!empty($post)) {
            $model->load($post);
            if(UploadedFile::getInstance($model, 'image') != null){
                $model->image = UploadedFile::getInstance($model, 'image');
                $model->image = $model->upload();
            }
            $model->state_id = Users::STATE_ACTIVE;
            $model->created_by_id = \Yii::$app->user->id;
            $model->created_on = date('Y-m-d H:i:s');
            $model->updated_on = date('Y-m-d H:i:s');
            if($model->save()){
                $title = 'New Post';
                $type = Notification::TYPE_NEW;
                $followers = Follow::find()->where([
                    'model_id' => $model->created_by_id,
                    'model' => get_class(new Users())
                ]);
                foreach ($followers->each() as $follower){
                    Notification::createNofication($title, $type, $model, $follower->user_id, 'feed');
                }
                return $this->redirect('site/index');
            }
        }
    }
    
    public function actionLikeFeed(){
        $model = new Like();
        $post = $this->request->post();
        if (!empty($post)) {
            $another = Like::findOne([
                'model' => $post['model'],
                'model_id' => $post['id'],
                'user_id' => \Yii::$app->user->id
            ]);
            if(!empty($another)){
                $another->delete();
                return true;
            }
            $model->model = $post['model'];
            $model->model_id = $post['id'];
            $model->user_id = \Yii::$app->user->id;
            $model->created_on = date('Y-m-d H:i:s');
            $model->updated_on = date('Y-m-d H:i:s');
            if ($model->save()) {
                return true;
            }
        }
    }
}

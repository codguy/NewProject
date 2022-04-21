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

/**
 * UserController implements the CRUD actions for Users model.
 */
class UserController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
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
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Users model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Users();
        $obj = rand(100,999);
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->created_on = date('Y-m-d H:i:s');
                $model->updated_on = date('Y-m-d H:i:s');
                $model->created_by_id = !empty(\Yii::$app->user->id) ? \Yii::$app->user->id : Users::ROLE_ADMIN;
                $model->state_id = Users::STATE_ACTIVE;
                $model->authKey = 'test'.$obj.'.key';
                $model->accessToken = $obj.'-token';
                $model->profile_picture = UploadedFile::getInstance($model, 'profile_picture');
                $model->upload();
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($model->save(false)) {
                        $title = 'New '.$model->getRole($model->roll_id);
                        $type = Notification::TYPE_NEW;
                        $users = Users::find()->where([
                            '<=',
                            'roll_id',
                            Users::ROLE_TRAINER
                        ]);
                        foreach ($users->each() as $user){
                            $notification = new Notification();
                            $notification->title = $title;
                            $notification->type_id = $type;
                            $notification->model_id = $model->id;
                            $notification->to_user_id = $user->id;
                            $notification->icon = 'user';
                            $notification->state_id = Notification::STATE_UNREAD;
                            $notification->model = get_class($model);
                            $notification->created_on = date('Y-m-d H:i:s');
                            $notification->created_by_id = !empty(\Yii::$app->user->id) ? \Yii::$app->user->id : Users::ROLE_ADMIN;
                            $notification->save(false);
                        }
                        $notification = new Notification();
                        $notification->title = 'Welcome';
                        $notification->type_id = Notification::TYPE_SUCCESS;
                        $notification->model_id = $model->id;
                        $notification->to_user_id = $model->id;
                        $notification->icon = 'user';
                        $notification->state_id = Notification::STATE_UNREAD;
                        $notification->model = get_class($model);
                        $notification->created_on = date('Y-m-d H:i:s');
                        $notification->created_by_id = !empty(\Yii::$app->user->id) ? \Yii::$app->user->id : Users::ROLE_ADMIN;
                        $notification->save(false);
                        $this->redirect([
                            'view',
                            'id' => $model->id
                        ]);
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

    public function actionCreateTrainer($model){
        
    }
    
    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        if ($this->request->isPost && $model->load($this->request->post())){
            $model->profile_picture = UploadedFile::getInstance($model, 'profile_picture');
            $model->upload();
            $model->updated_on = date('Y-m-d H:i:s');
            //             echo '<pre>';var_dump($model);die;
            if($model->save(false)) {
                $title = 'Updated : '.$model->username;
                $type = Notification::TYPE_UPDATED;
                $notification = new Notification();
                $notification->title = $title;
                $notification->type_id = $type;
                $notification->model_id = $model->id;
                $notification->to_user_id = $model->id;
                $notification->icon = 'user';
                $notification->state_id = Notification::STATE_UNREAD;
                $notification->model = get_class($model);
                $notification->created_on = date('Y-m-d H:i:s');
                $notification->created_by_id = !empty(\Yii::$app->user->id) ? \Yii::$app->user->id : Users::ROLE_ADMIN;
                $notification->save(false);
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
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Users::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(\Yii::t('app', 'The requested page does not exist.'));
    }
    
    public function actionAddSocial()
    {
        $model = new SocialLink();
        $post = $this->request->isPost;
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->created_on = date('Y-m-d H:i:s');
                $model->updated_on = date('Y-m-d H:i:s');
                $model->created_by_id = !empty(\Yii::$app->user->id) ? \Yii::$app->user->id : Users::ROLE_ADMIN;
                $model->state_id = Users::STATE_ACTIVE;
                $model->authKey = 'test'.$obj.'.key';
                $model->accessToken = $obj.'-token';
                $model->profile_picture = UploadedFile::getInstance($model, 'profile_picture');
                $model->upload();
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($model->save(false)) {
                        $title = 'New '.$model->getRole($model->roll_id);
                        $type = Notification::TYPE_NEW;
                        $users = Users::find()->where([
                            '<=',
                            'roll_id',
                            Users::ROLE_TRAINER
                        ]);
                        foreach ($users->each() as $user){
                            $notification = new Notification();
                            $notification->title = $title;
                            $notification->type_id = $type;
                            $notification->model_id = $model->id;
                            $notification->to_user_id = $user->id;
                            $notification->icon = 'user';
                            $notification->state_id = Notification::STATE_UNREAD;
                            $notification->model = get_class($model);
                            $notification->created_on = date('Y-m-d H:i:s');
                            $notification->created_by_id = !empty(\Yii::$app->user->id) ? \Yii::$app->user->id : Users::ROLE_ADMIN;
                            $notification->save(false);
                        }
                        $notification = new Notification();
                        $notification->title = 'Welcome';
                        $notification->type_id = Notification::TYPE_SUCCESS;
                        $notification->model_id = $model->id;
                        $notification->to_user_id = $model->id;
                        $notification->icon = 'user';
                        $notification->state_id = Notification::STATE_UNREAD;
                        $notification->model = get_class($model);
                        $notification->created_on = date('Y-m-d H:i:s');
                        $notification->created_by_id = !empty(\Yii::$app->user->id) ? \Yii::$app->user->id : Users::ROLE_ADMIN;
                        $notification->save(false);
                        $this->redirect([
                            'view',
                            'id' => $model->id
                        ]);
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
        
        return $this->render('add_social', [
            'model' => $model
        ]);
    }
}

<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Notification;
use app\models\Users;
use yii\web\UploadedFile;
use app\models\Feed;
use PHPUnit\Exception;
use yii\base\ErrorException;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            $this->layout = 'blank2';
            return $this->render('home');
        }
//         $searchModel = new Feed();
//         $dataProvider = $searchModel->search();
        $model = new Feed();
        return $this->render('index', [
            'model' => $model
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $this->layout = 'blank';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $this->layout = 'blank2';
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    
    public function actionSignUp()
    {
        $this->layout = 'blank';
        $model = new Users();
        $obj = rand(100, 999);
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->created_on = date('Y-m-d H:i:s');
                $model->updated_on = date('Y-m-d H:i:s');
                $model->created_by_id = ! empty(\Yii::$app->user->id) ? \Yii::$app->user->id : Users::ROLE_ADMIN;
                $model->state_id = Users::STATE_ACTIVE;
                $model->authKey = 'test' . $obj . '.key';
                $model->accessToken = $obj . '-token';
                if(UploadedFile::getInstance($model, 'profile_picture') != null){
                    $model->profile_picture = UploadedFile::getInstance($model, 'profile_picture');
                    $model->profile_picture = $model->upload();
                }
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($model->save(false)) {
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
                        $login = new LoginForm();
                        $login->setAttributes($model->attributes);
                        Yii::$app->user->login($model, 3600*24*30);
                        return $this->redirect([
                            'user/view',
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
        
        return $this->render('sign-up', [
            'model' => $model
        ]);
    }
}

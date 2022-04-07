<?php

namespace app\controllers;

use app\models\Dept;
use app\models\search\Dept as DeptSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Users;
use app\models\Notification;

/**
 * DeptController implements the CRUD actions for Dept model.
 */
class DeptController extends Controller
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
     * Lists all Dept models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new DeptSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Dept model.
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
     * Creates a new Dept model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Dept();

        if ($this->request->isPost) {
            $model->created_on = date('Y-m-d H:i:s');
            $model->updated_on = date('Y-m-d H:i:s');
            $model->created_by_id = !empty(\Yii::$app->user->id) ? \Yii::$app->user->id : Users::ROLE_ADMIN;
            if ($model->load($this->request->post()) && $model->save()) {
                $title = 'New Department';
                $type = Notification::TYPE_NEW;
                $users = Users::findAll([
                    '<=',
                    'roll_id',
                    Users::ROLE_STAFF
                ]);
                foreach ($users as $user){
                    $notification = new Notification();
                    $notification->title = $title;
                    $notification->type_id = $type;
                    $notification->model_id = $model->id;
                    $notification->to_user_id = $user->id;
                    $notification->icon = 'building';
                    $notification->state_id = Notification::STATE_UNREAD;
                    $notification->model = get_class($model);
                    $notification->created_on = date('Y-m-d H:i:s');
                    $notification->created_by_id = !empty(\Yii::$app->user->id) ? \Yii::$app->user->id : Users::ROLE_ADMIN;
                    $notification->save(false);
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Dept model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $model->updated_on = date('Y-m-d H:i:s');
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Dept model.
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
     * Finds the Dept model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Dept the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Dept::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}

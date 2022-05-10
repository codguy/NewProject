<?php

namespace app\controllers;

use app\models\Course;
use app\models\search\Course as CourseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Users;
use yii\web\UploadedFile;
use app\models\Chapter;
use Codeception\Lib\Actor\Shared\Comment;
use app\models\Discussion;

/**
 * CourseController implements the CRUD actions for Course model.
 */
class CourseController extends Controller
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
     * Lists all Course models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CourseSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Course model.
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
     * Creates a new Course model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Course();

        if ($this->request->isPost) {
            $model->load($this->request->post());
            $model->created_on = date('Y-m-d H:i:s');
            $model->updated_on = date('Y-m-d H:i:s');
            $model->created_by_id = ! empty(\Yii::$app->user->id) ? \Yii::$app->user->id : Users::ROLE_ADMIN;
            $model->trainer_id = ! empty(\Yii::$app->user->id) ? \Yii::$app->user->id : Users::ROLE_ADMIN;
            if(UploadedFile::getInstance($model, 'image') != null){
                $model->image = UploadedFile::getInstance($model, 'image');
                $model->image = $model->upload();
            }
            if ($model->save(false)) {
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
     * Updates an existing Course model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $image = $model->image;
        if ($this->request->isPost){
            if($model->load($this->request->post())){
                $model->updated_on = date('Y-m-d H:i:s');
                if(UploadedFile::getInstance($model, 'image') != null){
                    $model->image = UploadedFile::getInstance($model, 'image');
                    $model->image = $model->upload();
                }else{
                    $model->image = $image;
                }
                if($model->save(false)) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Course model.
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
     * Finds the Course model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Course the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Course::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(\Yii::t('app', 'The requested page does not exist.'));
    }
    
    public function actionAddChapter($id) {
        $model = new Chapter();
        $post = $this->request->post();
        if ($this->request->isPost) {
            $model->created_on = date('Y-m-d H:i:s');
            $model->updated_on = date('Y-m-d H:i:s');
            $model->created_by_id = ! empty(\Yii::$app->user->id) ? \Yii::$app->user->id : Users::ROLE_ADMIN;
            $model->course_id = $id;
            $model->desciption = $post['Chapter']['desciption'];
            if ($model->load($post) && $model->save(false)) {
                return $this->redirect(['view', 'id' => $id]);
            }
        }
        
        return $this->render('add_chapter', [
            'model' => $model,
            'id' => $id
        ]);
    }
    
    public function actionViewChapter($id)
    {
        return $this->render('_chapter', [
            'model' => Chapter::findOne($id),
        ]);
    }
    
    public function actionDiscuss() {
        $model = new Discussion();
        $post = $this->request->post();
        if ($this->request->isPost) {
            $model->message = $post['message'];
            $model->model = $post['model'];
            $model->model_id = $post['model_id'];
            $model->user_id = \Yii::$app->user->identity->id;
            $model->created_on = date('Y-m-d H:i:s');
            $model->updated_on = date('Y-m-d H:i:s');
            $model->created_by_id = \Yii::$app->user->id;
            if ($model->save(false)) {
                return true;
            }
        }
    }
}

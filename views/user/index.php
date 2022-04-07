<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Users;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\Users */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//         'filterModel' => $searchModel,
//         'enableRowClick' => true,
        'layout'=>'{items}{pager}',
        'class' =>'grid-view',
        'columns' => [
            ['class' => 'yii\grid\CheckboxColumn'],
            ['class' => 'yii\grid\SerialColumn'],

            'id',
//             'username',
            [
                'attribute' => 'username',
                'format' => 'raw',
                'value' => function($model){
                    return $model->getTableProfile($model);
                }
            ],
            'email:email',
//             'password',
//             'roll_id',
            [
                'attribute' => 'role',
                'value' => function($model){
                return $model->getRole($model->roll_id);
                }
            ],
//             'state_id',
            [
                'attribute' => 'state',
                'value' => function($model){
                return $model->getState($model->state_id);
                }
            ],
            'dob',
//             'created_on',
// //             'created_by_id',
//             [
//                 'attribute' => 'created_by',
//                 'filter' => $searchModel->created_by_id,
//                 'value' => function($model){
//                 return $model->getRole($model->roll_id);
//                 }
//             ],
            //'authKey',
            //'accessToken',
            'gender',
            //'profile_picture',
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {update} {delete}',
                'urlCreator' => function ($action, Users $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
//                     return Html::a('button', ['$action']);
                 },
                'buttons' => [
                    'view' => function($name, $model, $key){
                    return Html::a('<div class = "btn btn-warning"><i class="fa fa-eye text-white" aria-hidden="true"></i></div>', ['view','id'=>$model->id]);
                    },
                    'update' => function($name, $model, $key){
                    return Html::a('<div class = "btn btn-primary"><i class="fa fa-edit text-white" aria-hidden="true"></i></div>', ['update','id'=>$model->id]);
                    },
                    'delete' => function($name, $model, $key){
                    return Html::a('<div class = "btn btn-danger"><i class="fa fa-trash text-white" aria-hidden="true"></i></div>', ['delete','id'=>$model->id], ['data-method' => 'POST']);
                    }
                ],
            ],
            // 'pager' => [
            //     'class' => \kop\y2sp\ScrollPager::className(),
            //     'container' => '.grid-view',
            //     'item' => 'tr',
            //     'paginationSelector' => '.grid-view .pagination',
            //     'enabledExtensions' => [
            //         \kop\y2sp\ScrollPager::EXTENSION_TRIGGER,
            //         \kop\y2sp\ScrollPager::EXTENSION_SPINNER,
            //         \kop\y2sp\ScrollPager::EXTENSION_NONE_LEFT,
            //         \kop\y2sp\ScrollPager::EXTENSION_PAGING
            //     ],
            //     'triggerTemplate' => '<tr class="ias-trigger"><td colspan="100%" style="text-align: center"><a style="cursor: pointer">{text}</a></td></tr>',
            // ]
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
<script>
$( document ).ready(function() {
    console.log( "ready!" );
});
</script>
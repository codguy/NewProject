<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Course;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\Course */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Courses');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-index">

	<h1><?= Html::encode($this->title) ?></h1>

<?php 
echo ListView::widget([
    'dataProvider' => $dataProvider,
    'layout' => '{items}{pager}',
    'itemView' => '_card',
]);
?>
</div>


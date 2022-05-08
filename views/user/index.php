<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Users;
use yii\widgets\ListView;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\Users */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php Pjax::begin(['id' => 'users']); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
 <?php
    echo ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_card',
        'layout' => '{items}{pager}',
        'options' => ['class' => 'bd-highlight'],
        'itemOptions'  => ['class' => ""],
        //['class' => 'yii\grid\ActionColumn'],
        
    ]);
    ?>
    

    <?php Pjax::end(); ?>
 
   
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$( document ).ready(function() {
    console.log( "ready!" );
});
$(document).on('click','.follow',function(){
	var id = $(this).attr('data-id');
	var model = $(this).attr('data-key');
	var arr = {
	 	  	id : id,
	    	model : model
	}
	$.ajax({
	    type: 'POST',
        dataType: 'json',
	    data: arr,
		url: '<?= Url::toRoute(['user/follow'])?>',
		success: function(data) {
			location.reload();
		}
	});
});
</script>
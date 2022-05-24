<?php 
use yii\helpers\Html;

?>
<div class="card pull-left m-3" style="width:300px">
<?php if (strtotime($model->created_on) >= strtotime('now')-3600){ ?>
	<div class="ribbon-wrapper ribbon-lg">
		<div class="ribbon bg-primary">New Course</div>
	</div>
<?php }?>
  <img class="card-img-top" src="<?php echo $model->getImageUrl()?>" alt="Card image" style="height:200px; overflow:hidden;object-fit:cover;">
  <div class="card-body">
    <h4 class="card-title"><?php echo $model->name?></h4>
    <p class="card-text">Trainer : <?php echo $model->trainer?><br><?php echo $model->getDificulty($model->dificulty)?></p>
    <?php echo Html::a('View Course', ['course/view', 'id' => $model->id], ['class' => 'btn btn-primary'])?>
  </div>
</div>
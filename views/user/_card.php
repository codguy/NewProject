<?php 
use yii\helpers\Html;
use app\models\Follow;
use yii\helpers\Url;

$followers = Follow::find()->where([
    'model' => get_class($model),
    'model_id' => $model->id
])->count();

$following = Follow::find()->where([
    'model' => get_class($model),
    'model_id' => $model->id
])
->andWhere([
    'user_id' => Yii::$app->user->identity->id
])
->one();
$msg = ! empty($following) ? 'Unfollow' : 'Follow';
$btn = ! empty($following) ? 'btn-outline-info' : 'btn-primary';
?>

<div class="col-md-6 col-xl-4 float-left user" id="<?php echo $model->id ?>">                       
  <div class="card">
    <div class="card-body">
      <div class="media align-items-center"><img class="profile_pic" src="<?php echo $model->getImageUrl()?>" style="width: 150px;height:150px; overflow:hidden;object-fit:cover;">
        <div class="media-body overflow-hidden ml-4">
          <h5 class="card-text mb-0"><?php echo $model->name?></h5>
          <p class="card-text text-uppercase text-muted"><?php echo $model->getRole($model->roll_id)?></p>
          <p class="card-text">
           Followers : <span class="followers-count" id="<?php echo $model->id?>"> <?php echo $followers?></span><br>
			  <?php echo  Html::button($msg,['class'=> "btn $btn follow", 'id'=>$model->id, 'data-id' => $model->id, 'data-key' => get_class($model)]);
			        echo Html::a('<div class = "btn btn-warning m-1"><i class="fa fa-eye text-white" aria-hidden="true"></i></div>', ['view','id'=>$model->id]);
			        echo Html::a('<div class = "btn btn-primary m-1"><i class="fa fa-edit text-white" aria-hidden="true"></i></div>', ['update','id'=>$model->id]);
			        echo Html::a('<div class = "btn btn-danger m-1"><i class="fa fa-trash text-white" aria-hidden="true"></i></div>', ['delete','id'=>$model->id]);
			  ?>
         
        </div>
      </div><a href="#" class="tile-link"></a>
    </div>
  </div>
</div>
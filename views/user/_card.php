<?php 
use yii\helpers\Html;
use app\models\Follow;
use yii\helpers\Url;
use app\models\Users;

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
  <?php if (strtotime($model->created_on) >= strtotime('now')-3600){ ?>
	<div class="ribbon-wrapper ribbon-lg">
		<div class="ribbon bg-primary">New User</div>
	</div>
<?php }?>                      
    <div class="card-body">
      <?php echo Html::a(' 
      <div class="media align-items-center"><img class="profile_pic" src="'. $model->getImageUrl().'" style="width: 150px;height:150px; overflow:hidden;object-fit:cover;">
        <div class="media-body overflow-hidden ml-4">
          <h5 class="card-text mb-0">'. $model->name.'</h5>
      ',['user/view', 'id' => $model->id])?>
          <p class="card-text text-uppercase text-muted"><?php echo $model->getRole($model->roll_id)?></p>
          <p class="card-text">
           Followers : <span class="followers-count" id="<?php echo $model->id?>"> <?php echo $followers?></span><br>
			  <?php echo  Html::button($msg,['class'=> "btn $btn follow", 'id'=>$model->id, 'data-id' => $model->id, 'data-key' => get_class($model)]);
			             $isAdmin = Users::isAdmin() ? '': 'd-none';
    			        echo Html::a('<div class = "btn btn-primary m-1 btn-xs '.$isAdmin.'"><i class="fa fa-edit text-white" aria-hidden="true"></i></div>', ['update','id'=>$model->id]);
    			        echo Html::a('<div class = "btn btn-danger m-1 btn-xs '.$isAdmin.'"><i class="fa fa-trash text-white" aria-hidden="true"></i></div>', ['delete','id'=>$model->id]);
			  ?>
         
        </div>
      </div><a href="#" class="tile-link"></a>
    </div>
  </div>
</div>
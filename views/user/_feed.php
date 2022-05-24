
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<?php
use app\models\Users;
use yii\helpers\Url;
use app\models\Like;
use app\models\Discussion;
use yii\helpers\Html;
?>
    <?php
    $user = Users::findOne($model->created_by_id);
    $self = Users::findOne(Yii::$app->user->id);
    $liked = ! empty(Like::findOne([
        'user_id' => Yii::$app->user->id,
        'model' => get_class($model),
        'model_id' => $model->id
    ])) ? 'primary' : '';
    $like_count = Like::find()->where([
        'model' => get_class($model),
        'model_id' => $model->id
    ])->count();
    ?>

<div class="social-feed-box card">
    <?php if (strtotime($model->created_on) >= strtotime('now')-3600){ ?>
    	<div class="ribbon-wrapper ribbon-lg">
    		<div class="ribbon bg-primary">New post</div>
    	</div>
	<?php }?>
        <div class="social-avatar">
		<a href="" class="pull-left">
                <?php echo $user->getImage()?>
            </a>
		<div class="media-body">
			<a href="#">
                    <?php echo $user->username?>
                </a> <small class="text-muted"><?php echo date('M d, Y H:i A', strtotime($model->created_on))?></small>
		</div>
	</div>
	<div class="social-body">
		<h2 class="ml-4"><?php echo $model->title?></h2>
		<p class="ml-4">
                <?php echo $model->desciption ?>
            </p>
            <?php if($model->image){ ?>
            <img src="<?php echo $model->getImageUrl()?>"
			class="img-responsive col-11 m-4">
            <?php } ?>
            <div class="btn-group">
			<button class="btn btn-white btn-xs like-btn"
				data-id="<?php echo $model->id?>"
				data-key="<?php echo get_class($model)?>">
				<i class="fa fa-thumbs-up text-<?php echo $liked?> mr-2"></i><?php echo $like_count?></button>
			<button class="btn btn-white btn-xs">
				<i class="fa fa-comments"></i> Comment
			</button>
			<button class="btn btn-white btn-xs">
				<i class="fa fa-share"></i> Share
			</button>
		</div>
	</div>
	<div class="social-footer" style="overflow: hidden">
		<div class="social-comment">
        		<?php
        $comments = Discussion::find()->where([
            'model' => get_class($model),
            'model_id' => $model->id
        ]);

        if (! empty($comments)) {
            foreach ($comments->each() as $comment) {
                $person = Users::findOne($comment->user_id);
                ?>
				<div class="d-flex m-3">
				<div class="flex-shrink-0">
					<img class="rounded-circle"
						src="<?php echo $person->getImageUrl() ?>" height="50px"
						width="50px" alt="..."
						style="overflow: hidden; object-fit: cover;" />
				</div>
				<div class="ms-3 ml-3">
					<div class="fw-bold">
						<span class="font-weight-bold"><?php echo $person->username ?></span><small
							class="font-weight-light ml-2"><?php echo date('M d, Y h:i A', strtotime($comment->created_on)) ?></small>
					</div>
						<?php echo $comment->message ?>
					</div>
			</div>
				<?php
            }
        }
        ?>
			<div class="social-comment">
				<div class="row">
					<a href="" class="pull-left">
                    <?php echo $self->image?>
                </a>
					<div class="media-body pull-left col-11">
						<textarea class="form-control" placeholder="Write comment..."
							id="discuss<?php echo $model->id?>"></textarea>
                    <?php echo Html::button('send',[ "id"=>"discuss-btn", "class"=>"btn btn-secondary float-right discuss-btn", 'data-id'=>$model->id, 'data-key'=>get_class($model)])?>
                </div>
				</div>
			</div>

		</div>

	</div>
</div>

<script>
$(document).on('click', '.like-btn', function(e){
	var id = $(this).attr('data-id');
	var model = $(this).attr('data-key');
	var arr = {
		id: id,
		model: model,
	}
	$.ajax({
	    type: 'POST',
        dataType: 'json',
	    data: arr,
		url: '<?= Url::toRoute(['user/like-feed'])?>',
		success: function(data) {
			location.reload();
		}
	});
		e.stopImmediatePropagation();
		return false;
});

$(document).on('click', '.discuss-btn', function(e){
	var model_id = $(this).attr('data-id');
	var msg = $('#discuss'+model_id).val();
	var model = $(this).attr('data-key');
	var arr = {
		message: msg,
		model: model,
		model_id: model_id
	}
	$.ajax({
	    type: 'POST',
        dataType: 'json',
	    data: arr,
		url: '<?= Url::toRoute(['course/discuss'])?>',
		success: function(data) {
			location.reload();
		}
	});
		e.stopImmediatePropagation();
		return false;
});
</script>
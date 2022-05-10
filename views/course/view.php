<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Users;
use app\models\Chapter;
use yii\helpers\Url;
use app\models\Discussion;

/* @var $this yii\web\View */
/* @var $model app\models\Course */

$this->title = $model->name;
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Courses'),
    'url' => [
        'index'
    ]
];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>


<div class="container mt-5">
	<div class="row">
		<div class="col-lg-8">
			<!-- Post content-->
			<article>
				<!-- Post header-->
				<header class="mb-4">
					<!-- Post title-->
					<h1 class="fw-bolder mb-1"><?php echo $model->name ?></h1>
					<!-- Post meta content-->
					<div class="text-muted fst-italic mb-2">Posted on <?php echo date("M d, Y", strtotime($model->created_on)) ?> by <?php echo (Users::findOne([$model->trainer_id]))->username?></div>
					<!-- Post categories-->
					<a class="badge bg-secondary text-decoration-none link-light"
						href="#!">Web Design</a> <a
						class="badge bg-secondary text-decoration-none link-light"
						href="#!">Freebies</a>
				</header>
				<!-- Preview image figure-->
				<figure class="mb-4"><?php echo $model->getImage();?></figure>
				<!-- Post content-->
				<!-- https://dummyimage.com/900x400/ced4da/6c757d.jpg -->
				<section class="mb-5">
                            <?php echo $model->desciption ?>
                        </section>
			</article>
			<!-- Comments section-->
			<section class="mb-5">
				<div class="card bg-light">
					<div class="card-body">
						<!-- Comment form-->
						<form class="mb-4">
							<textarea class="form-control" rows="3" id="discuss"
								placeholder="Join the discussion and leave a comment!"></textarea>
							<?php echo Html::button('send',[ "id"=>"discuss-btn", "class"=>"btn btn-secondary float-right", 'data-id'=>$model->id, 'data-key'=>get_class($model)])?>
						</form>
						<!-- Comment with nested comments-->
<!-- 						<div class="d-flex mb-4"> -->
							<!-- Parent comment-->
<!-- 							<div class="flex-shrink-0"> -->
<!-- 								<img class="rounded-circle" -->
<!-- 									src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /> -->
<!-- 							</div> -->
<!-- 							<div class="ms-3"> -->
<!-- 								<div class="fw-bold">Commenter Name</div> -->
<!-- 								If you're going to lead a space frontier, it has to be -->
<!-- 								government; it'll never be private enterprise. Because the space -->
<!-- 								frontier is dangerous, and it's expensive, and it has -->
<!-- 								unquantified risks. -->
								<!-- Child comment 1-->
<!-- 								<div class="d-flex mt-4"> -->
<!-- 									<div class="flex-shrink-0"> -->
<!-- 										<img class="rounded-circle" -->
<!-- 											src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" -->
<!-- 											alt="..." /> -->
<!-- 									</div> -->
<!-- 									<div class="ms-3"> -->
<!-- 										<div class="fw-bold">Commenter Name</div> -->
<!-- 										And under those conditions, you cannot establish a -->
<!-- 										capital-market evaluation of that enterprise. You can't get -->
<!-- 										investors. -->
<!-- 									</div> -->
<!-- 								</div> -->
<!-- 							</div> -->
<!-- 						</div> -->
						<!-- Single comment-->
						<?php 
						      $comments = Discussion::find()->where([
						          'model' => get_class($model),
						          'model_id' => $model->id
						      ]);
						      
						      if(!empty($comments)){
						          foreach ($comments->each() as $comment){
						              $person = Users::findOne($comment->user_id);
						?>
						<div class="d-flex m-3">
							<div class="flex-shrink-0">
								<img class="rounded-circle"
									src="<?php echo $person->getImageUrl() ?>" height="50px" width="50px" alt="..." style="overflow:hidden;object-fit:cover;" />
							</div>
							<div class="ms-3 ml-3">
								<div class="fw-bold"><span class="font-weight-bold"><?php echo $person->username ?></span><small class="font-weight-light ml-2"><?php echo date('M d, Y H:i A', strtotime($comment->created_on)) ?></small></div>
								<?php echo $comment->message ?>
							</div>
						</div>
						<?php 
						          }
						      }
						?>
					</div>
				</div>
			</section>
		</div>
		<!-- Side widgets-->
		<div class="col-lg-4">
			<!-- Search widget-->
			<p>
			<?php 
			$toSelf = Users::isSelf($model->trainer_id)  ? '' : 'd-none';
			$to_admin = Users::isAdmin()||Users::isSelf($model->trainer_id) ? '' : 'd-none';
			?>
                <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary '.$to_admin]) ?>
                <?=Html::a(Yii::t('app', 'Delete'), ['delete','id' => $model->id], ['class' => 'btn btn-danger '.$to_admin,'data' => ['confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),'method' => 'post']])?>
            </p>
			<div class="card mb-4">
				<div class="card-header">Search</div>
				<div class="card-body">
					<div class="input-group">
						<input class="form-control" type="text"
							placeholder="Enter search term..."
							aria-label="Enter search term..."
							aria-describedby="button-search" />
						<button class="btn btn-primary" id="button-search" type="button">Go!</button>
					</div>
				</div>
			</div>
			<!-- Categories widget-->
			<div class="card mb-4">
				<div class="card-header">Chapters	</div>
				<div class="card-body">
					<div class="row">
					<ul class="list-unstyled mb-0">
						<?php 
						$chapters = Chapter::find()->where([
						    'course_id' => $model->id
						]);
						echo !empty($chapters->count()) ? '' : 'No chapter added';
						$count =1;
						foreach ($chapters->each() as $chapter){
						    echo Html::a('<li style="width: 200px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">Chapter : '.$count++.' '.$chapter->title.'</li>', ['course/view-chapter', 'id'=> $chapter->id]);
						}
						echo Html::a('Add Chapters', ['course/add-chapter', 'id' => $model->id], ['class' => 'badge btn btn-outline-primary '.$toSelf]);
						?>
						</ul>
					</div>
				</div>
			</div>
			<!-- Side widget-->
			<div class="card mb-4">
				<div class="card-header">Side Widget</div>
				<div class="card-body">You can put anything you want inside of these
					side widgets. They are easy to use, and feature the Bootstrap 5
					card component!</div>
			</div>
		</div>
	</div>
</div>
<script>
$(document).on('click', '#discuss-btn', function(){
	var msg = $('#discuss').val();
	var model_id = $(this).attr('data-id');
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
});
</script>

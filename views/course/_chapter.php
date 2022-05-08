<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Users;
use app\models\Chapter;
use app\models\Course;

/* @var $this yii\web\View */
/* @var $model app\models\Course */

$this->title = $model->title;
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
		<div class="col-lg-12">
			<!-- Post content-->
			<article>
				<!-- Post header-->
				<header class="mb-4">
					<!-- Post title-->
					<h1 class="fw-bolder mb-1"><?php echo $model->title ?></h1>
					<!-- Post meta content-->
					<div class="text-muted fst-italic mb-2">Posted on <?php echo date("M d, Y", strtotime($model->created_on)) ?> by <?php echo (Course::findOne([$model->course_id]))->name?></div>
					<!-- Post categories-->
					<a class="badge bg-secondary text-decoration-none link-light"
						href="#!">Web Design</a> <a
						class="badge bg-secondary text-decoration-none link-light"
						href="#!">Freebies</a>
				</header>
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
							<textarea class="form-control" rows="3"
								placeholder="Join the discussion and leave a comment!"></textarea>
						</form>
						<!-- Comment with nested comments-->
						<div class="d-flex mb-4">
							<!-- Parent comment-->
							<div class="flex-shrink-0">
								<img class="rounded-circle"
									src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." />
							</div>
							<div class="ms-3">
								<div class="fw-bold">Commenter Name</div>
								If you're going to lead a space frontier, it has to be
								government; it'll never be private enterprise. Because the space
								frontier is dangerous, and it's expensive, and it has
								unquantified risks.
								<!-- Child comment 1-->
								<div class="d-flex mt-4">
									<div class="flex-shrink-0">
										<img class="rounded-circle"
											src="https://dummyimage.com/50x50/ced4da/6c757d.jpg"
											alt="..." />
									</div>
									<div class="ms-3">
										<div class="fw-bold">Commenter Name</div>
										And under those conditions, you cannot establish a
										capital-market evaluation of that enterprise. You can't get
										investors.
									</div>
								</div>
								<!-- Child comment 2-->
								<div class="d-flex mt-4">
									<div class="flex-shrink-0">
										<img class="rounded-circle"
											src="https://dummyimage.com/50x50/ced4da/6c757d.jpg"
											alt="..." />
									</div>
									<div class="ms-3">
										<div class="fw-bold">Commenter Name</div>
										When you put money directly to a problem, it makes a good
										headline.
									</div>
								</div>
							</div>
						</div>
						<!-- Single comment-->
						<div class="d-flex">
							<div class="flex-shrink-0">
								<img class="rounded-circle"
									src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." />
							</div>
							<div class="ms-3">
								<div class="fw-bold">Commenter Name</div>
								When I look at the universe and all the ways the universe wants
								to kill us, I find it hard to reconcile that with statements of
								beneficence.
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
		<!-- Side widgets-->
		
	</div>
</div>

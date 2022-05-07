<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\SocialLink;
use app\models\Follow;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;
use app\models\Skill;
use app\models\Users;
use kartik\icons\Icon;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

\yii\web\YiiAsset::register($this);
?>
<style>
body {
	margin-top: 20px;
	background: #ebeef0;
}

.img-sm {
	width: 46px;
	height: 46px;
}

.img-xs {
	width: 32px;
	height: 32px;
}

.img-holder img {
	max-width: 100%;
	border-radius: 0;
}

.panel {
	box-shadow: 0 2px 0 rgba(0, 0, 0, 0.075);
	border-radius: 0;
	border: 0;
	margin-bottom: 15px;
}

.panel .panel-footer, .panel>:last-child {
	border-bottom-left-radius: 0;
	border-bottom-right-radius: 0;
}

.panel .panel-heading, .panel>:first-child {
	border-top-left-radius: 0;
	border-top-right-radius: 0;
}

.panel-body {
	padding: 25px 20px;
}

.timeline {
	position: relative;
	padding-bottom: 40px;
	background-color: #ebeef0;
	color: #5f5f5f
}

.timeline:before, .timeline:after {
	background-color: #cad3df;
	bottom: 20px;
	content: "";
	display: block;
	position: absolute
}

.timeline:before {
	left: 49px;
	top: 20px;
	width: 2px
}

.timeline:after {
	left: 47px;
	width: 6px;
	height: 6px;
	border-radius: 50%
}

.timeline-header {
	border-radius: 0;
	clear: both;
	margin-bottom: 50px;
	margin-top: 50px;
	position: relative
}

.timeline-header .timeline-header-title {
	display: inline-block;
	text-align: center;
	padding: 7px 15px;
	min-width: 100px
}

.timeline .timeline-header:first-child {
	margin-bottom: 30px;
	margin-top: 15px
}

.timeline-stat {
	width: 100px;
	float: left;
	text-align: center;
	padding-bottom: 15px
}

.timeline-entry {
	margin-bottom: 50px;
	margin-top: 5px;
	position: relative;
	clear: both
}

.timeline-entry-inner {
	position: relative
}

.timeline-time {
	display: inline-block;
	padding: 5px 3px 7px;
	margin-top: 3px;
	background-color: #ebeef0;
	color: #929292;
	font-size: .85em;
	max-width: 70px
}

.timeline-icon {
	border-radius: 50%;
	box-shadow: 0 0 0 7px #ebeef0;
	display: block;
	margin: 0 auto;
	height: 46px;
	line-height: 46px;
	text-align: center;
	width: 46px
}

.timeline-icon img {
	width: 46px;
	height: 46px;
	border-radius: 50%;
	vertical-align: top
}

.timeline-icon:empty {
	height: 10px;
	width: 10px;
	margin-top: 20px;
	background-color: #a4b4c7
}

.timeline-label {
	background-color: #fff;
	border-radius: 0;
	margin-left: 90px;
	padding: 10px;
	position: relative;
	min-height: 50px;
	border: 1px solid #e9e9e9;
	-webkit-box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 6px 10px 0
		rgba(0, 0, 0, 0.3);
	box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 6px 10px 0
		rgba(0, 0, 0, 0.3);
}

.timeline-label:before, .timeline-label:after {
	content: "";
	display: block;
	position: absolute;
	width: 0;
	height: 0;
	left: 0;
	top: 0
}

.timeline-label:before {
	border-top: 10px solid transparent;
	border-bottom: 10px solid transparent;
	border-right: 10px solid #e6e6e6;
	margin: 15px 0 0 -10px
}

.timeline-label:after {
	border-top: 9px solid transparent;
	border-bottom: 9px solid transparent;
	border-right: 9px solid #fff;
	margin: 15px 0 0 -8px
}

.panel .timeline, .panel .timeline-time {
	background-color: #fff
}

.panel .timeline-icon {
	box-shadow: 0 0 0 7px #fff
}

.panel .timeline-label {
	box-shadow: none;
	background-color: #f7f7f7;
	border: 1px solid #e3e3e3
}

.panel .timeline-label:before {
	border-right-color: #e3e3e3
}

.panel .timeline-label:after {
	border-right-color: #f7f7f7
}

@media ( min-width :768px) {
	.two-column.timeline {
		text-align: center
	}
	.two-column.timeline:before {
		left: 50%
	}
	.two-column.timeline:after {
		left: 50%;
		margin-left: -2px
	}
	.two-column.timeline .timeline-entry {
		width: 50%;
		text-align: left
	}
	.two-column.timeline .timeline-stat {
		margin-left: -50px
	}
	.two-column.timeline .timeline-entry:nth-child(odd) {
		float: right
	}
	.two-column.timeline .timeline-entry:nth-child(odd) .timeline-label {
		margin-left: 40px
	}
	.two-column.timeline .timeline-header {
		text-align: center
	}
	.two-column.timeline .timeline-entry:nth-child(even) {
		float: left
	}
	.two-column.timeline .timeline-entry:nth-child(even) .timeline-stat {
		left: 100%;
		position: relative;
		margin-left: -50px
	}
	.two-column.timeline .timeline-entry:nth-child(even) .timeline-label {
		left: -90px;
		margin-right: -40px
	}
	.two-column.timeline .timeline-entry:nth-child(even) .timeline-label:before,
		.two-column.timeline .timeline-entry:nth-child(even) .timeline-label:after
		{
		left: auto;
		right: 0;
		border-right: 0 solid transparent
	}
	.two-column.timeline .timeline-entry:nth-child(even) .timeline-label:before
		{
		border-top: 10px solid transparent;
		border-bottom: 10px solid transparent;
		border-left: 10px solid #e6e6e6;
		margin: 15px -10px 0 0
	}
	.two-column.timeline .timeline-entry:nth-child(even) .timeline-label:after
		{
		border-top: 9px solid transparent;
		border-bottom: 9px solid transparent;
		border-left: 9px solid #fff;
		margin: 15px -8px 0 0
	}
}

.bg-dark, .bg-dark a {
	color: #fff;
}

.bg-dark {
	background-color: #33373a;
}

.mar-top {
	margin-top: 15px;
}

.btn-trans.btn-icon.fa.add-tooltip {
	margin: 0px 15px;
}
</style>
<div class="users-view">

	<div class="container">
		<div class="main-body">

			<!-- Breadcrumb -->
			<nav aria-label="breadcrumb" class="main-breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?= Html::a('Home', ['site/index']) ?></li>

					<li class="breadcrumb-item"><?= Html::a('Users', ['user/index']) ?></li>
					<li class="breadcrumb-item active" aria-current="page">User Profile</li>
				</ol>
			</nav>
			<!-- /Breadcrumb -->

			<div class="row gutters-sm">
				<div class="col-md-4 mb-3">
					<div class="card">
						<div class="card-body">
							<div class="d-flex flex-column align-items-center text-center">
								<img src="<?= $model->getImageUrl() ?>" alt="Admin"
									class="profile_pic" height="180" width="180">
								<div class="mt-3">
									<h4><?= $model->username ?></h4>
                      <?php
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
                        $delete = (Yii::$app->user->identity->roll_id != Users::ROLE_ADMIN || Yii::$app->user->identity->id == $model->id) ? 'd-none' : '';
                        $update = (Yii::$app->user->identity->roll_id > Users::isManager()) ? 'd-none' : '';
                        ?>
                    
                      <p class="text-secondary mb-1"><span class="followers-count"><?= $followers ?></span> followers</p>
					  <?= Html::button($msg,['class'=> "btn $btn", 'id'=>'follow', 'data-id' => $model->id, 'data-key' => get_class($model)]) ?>
                      <?= Html::a('Update', ['user/update','id'=>$model->id],['class'=> "btn btn-warning $update"]) ?>
                      <?= Html::a('Delete', ['user/delete','id'=>$model->id],['class'=> "btn btn-outline-danger $delete", 'data-method'=>'POST']) ?>
<!--                       <button class="btn btn-outline-primary">Message</button> -->
								</div>
							</div>
						</div>
					</div>
					<div class="card mt-3">
						<ul class="list-group list-group-flush">
							<li
								class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
								<h6 class="mb-0">Social Links</h6>
                    <?php echo  Html::a('<i class="fa fa-plus"></i>',['user/add-social','user_id' => $model->id],['class' => 'btn btn-primary'])?>
                  </li>
                  <?php
                $socials = SocialLink::find()->where([
                    'user_id' => $model->id
                ]);
                $list = [];
                foreach ($socials->each() as $social) {
                    $list[$social->platform] = $social->link;
                }
                ?>
                  <?php if (!empty($list['website'])) {?>
                  <li
								class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
								<h6 class="mb-0">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
										viewBox="0 0 24 24" fill="none" stroke="currentColor"
										stroke-width="2" stroke-linecap="round"
										stroke-linejoin="round"
										class="feather feather-globe mr-2 icon-inline">
										<circle cx="12" cy="12" r="10"></circle>
										<line x1="2" y1="12" x2="22" y2="12"></line>
										<path
											d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
									Website
								</h6> <span class="text-secondary"><?php echo $list['website']?></span>
							</li>
                  <?php
                }
                if (! empty($list['github'])) {
                    ?>
                  <li
								class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
								<h6 class="mb-0">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
										viewBox="0 0 24 24" fill="none" stroke="currentColor"
										stroke-width="2" stroke-linecap="round"
										stroke-linejoin="round"
										class="feather feather-github mr-2 icon-inline">
										<path
											d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg>
									Github
								</h6> <span class="text-secondary"><?php echo $list['github']?></span>
							</li>
                  <?php
                }
                if (! empty($list['twitter'])) {
                    ?>
                  
                  <li
								class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
								<h6 class="mb-0">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
										viewBox="0 0 24 24" fill="none" stroke="currentColor"
										stroke-width="2" stroke-linecap="round"
										stroke-linejoin="round"
										class="feather feather-twitter mr-2 icon-inline text-info">
										<path
											d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>
									Twitter
								</h6> <span class="text-secondary"><?php echo $list['twitter']?></span>
							</li>
                  <?php
                }
                if (! empty($list['instagram'])) {
                    ?>
                  
                  <li
								class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
								<h6 class="mb-0">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
										viewBox="0 0 24 24" fill="none" stroke="currentColor"
										stroke-width="2" stroke-linecap="round"
										stroke-linejoin="round"
										class="feather feather-instagram mr-2 icon-inline text-danger">
										<rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
										<path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
										<line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
									Instagram
								</h6> <span class="text-secondary"><?php echo $list['instagram']?></span>
							</li>
                  <?php
                }
                if (! empty($list['facebook'])) {
                    ?>
                  
                  <li
								class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
								<h6 class="mb-0">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
										viewBox="0 0 24 24" fill="none" stroke="currentColor"
										stroke-width="2" stroke-linecap="round"
										stroke-linejoin="round"
										class="feather feather-facebook mr-2 icon-inline text-primary">
										<path
											d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
									Facebook
								</h6> <span class="text-secondary"><?php echo $list['facebook']?></span>
							</li>
                  <?php
                }
                ?>
                  
                </ul>
					</div>
				</div>
				<div class="col-md-8">
					<div class="card mb-3">
						<div class="card-body">
							<div class="row">
								<div class="col-sm-3">
									<h6 class="mb-0">Full Name</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                      <?= $model->username ?>
                    </div>
							</div>
							<hr>
							<div class="row">
								<div class="col-sm-3">
									<h6 class="mb-0">Email</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                      <?= $model->email ?>
                    </div>
							</div>
							<hr>
							<div class="row">
								<div class="col-sm-3">
									<h6 class="mb-0">State</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<span
										class="badge badge-<?= $model->getBadge($model->state_id) ?>"><?= $model->getState($model->state_id) ?></span>

								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-sm-3">
									<h6 class="mb-0">Date of birth</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                      <?= date('d-M-Y',strtotime($model->dob)) ?>
                    </div>
							</div>
							<hr>
							<div class="row">
								<div class="col-sm-3">
									<h6 class="mb-0">Gender</h6>
								</div>
								<div class="col-sm-9 text-secondary">
                      <?= $model->gender ?>
                    </div>
							</div>
						</div>
					</div>

					<div class="modal fade" id="skillModalCenter" tabindex="-1"
						role="dialog" aria-labelledby="exampleModalCenterTitle"
						aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLongTitle">Add New
										Skill</h5>
									<button type="button" class="close" data-dismiss="modal"
										aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<label for="customRange2" class="form-label">Skill Proficiency</label>
									<input type="text" class="form-control" name="Skill"
										id="skill-name"> <label for="level" class="form-label">Skill
										Proficiency</label><br /> <input type="range"
										class="form-range col-12" min="0" max="2" id="level">
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary"
										data-dismiss="modal">Close</button>
									<button type="button" class="btn btn-primary" id="skill-submit"
										data-id="<?php echo $model->id ?>"
										data-key="<?php echo get_class($model)?>">Save</button>
								</div>
							</div>
						</div>
					</div>

					<div class="card">
						<div class="card-body skill-card">
							<h6>
								<b>Skills : </b>
							</h6>
                            <?php
                            $skills = Skill::find()->where([
                                'model' => get_class($model),
                                'model_id' => $model->id
                            ]);
                            if (! empty($skills->count())) {
                                foreach ($skills->each() as $skill) {
                                    echo Users::getSkillBadge($skill->skill, $skill->level);
                                }
                            }
                            echo Html::a('<i class="fa fa-plus"></i>', [
                                '#'
                            ], [
                                'class' => 'badge badge-primary',
                                'id' => 'add-skill',
                                'data-toggle' => "modal",
                                'data-target' => "#skillModalCenter"
                            ])?>
                         </div>
					</div>

					<div class="row gutters-sm">
						<div class="col-sm-6 mb-3">
							<div class="card h-100">
								<div class="card-body">
									<h6 class="d-flex align-items-center mb-3">
										<i class="material-icons text-info mr-2">assignment</i>Project
										Status
									</h6>
									<small>Web Design</small>
									<div class="progress mb-3" style="height: 5px">
										<div class="progress-bar bg-primary" role="progressbar"
											style="width: 80%" aria-valuenow="80" aria-valuemin="0"
											aria-valuemax="100"></div>
									</div>
									<small>Website Markup</small>
									<div class="progress mb-3" style="height: 5px">
										<div class="progress-bar bg-primary" role="progressbar"
											style="width: 72%" aria-valuenow="72" aria-valuemin="0"
											aria-valuemax="100"></div>
									</div>
									<small>One Page</small>
									<div class="progress mb-3" style="height: 5px">
										<div class="progress-bar bg-primary" role="progressbar"
											style="width: 89%" aria-valuenow="89" aria-valuemin="0"
											aria-valuemax="100"></div>
									</div>
									<small>Mobile Template</small>
									<div class="progress mb-3" style="height: 5px">
										<div class="progress-bar bg-primary" role="progressbar"
											style="width: 55%" aria-valuenow="55" aria-valuemin="0"
											aria-valuemax="100"></div>
									</div>
									<small>Backend API</small>
									<div class="progress mb-3" style="height: 5px">
										<div class="progress-bar bg-primary" role="progressbar"
											style="width: 66%" aria-valuenow="66" aria-valuemin="0"
											aria-valuemax="100"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 mb-3">
							<div class="card h-100">
								<div class="card-body">
									<h6 class="d-flex align-items-center mb-3">
										<i class="material-icons text-info mr-2">assignment</i>Project
										Status
									</h6>
									<small>Web Design</small>
									<div class="progress mb-3" style="height: 5px">
										<div class="progress-bar bg-primary" role="progressbar"
											style="width: 80%" aria-valuenow="80" aria-valuemin="0"
											aria-valuemax="100"></div>
									</div>
									<small>Website Markup</small>
									<div class="progress mb-3" style="height: 5px">
										<div class="progress-bar bg-primary" role="progressbar"
											style="width: 72%" aria-valuenow="72" aria-valuemin="0"
											aria-valuemax="100"></div>
									</div>
									<small>One Page</small>
									<div class="progress mb-3" style="height: 5px">
										<div class="progress-bar bg-primary" role="progressbar"
											style="width: 89%" aria-valuenow="89" aria-valuemin="0"
											aria-valuemax="100"></div>
									</div>
									<small>Mobile Template</small>
									<div class="progress mb-3" style="height: 5px">
										<div class="progress-bar bg-primary" role="progressbar"
											style="width: 55%" aria-valuenow="55" aria-valuemin="0"
											aria-valuemax="100"></div>
									</div>
									<small>Backend API</small>
									<div class="progress mb-3" style="height: 5px">
										<div class="progress-bar bg-primary" role="progressbar"
											style="width: 66%" aria-valuenow="66" aria-valuemin="0"
											aria-valuemax="100"></div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="container bootstrap snippets bootdeys">
						<div class="col-md-12 col-md-offset-2">
							<div class="panel">
								<div class="panel-body">
									<textarea class="form-control" rows="2"
										placeholder="What are you thinking?"></textarea>
									<div class="mar-top clearfix">
										<button class="btn btn-sm btn-primary pull-right"
											type="submit">
											<i class="fa fa-sm fa-pen"></i> Share
										</button>
										<!-- <a class="btn-trans btn-icon fa fa-video-camera add-tooltip" href="#"
											data-original-title="Add Video" data-toggle="tooltip"></a>  -->
										<a class="btn-trans btn-icon fa fa-camera add-tooltip"
											href="#" data-original-title="Add Photo"
											data-toggle="tooltip"></a> 
										<!-- <a class="btn-trans btn-icon fa fa-file add-tooltip"
											href="#" data-original-title="Add File" data-toggle="tooltip"></a> -->
									</div>
								</div>
							</div>
							<div class="panel panel-body">
								<!-- Timeline -->
								<!--===================================================-->
								<div class="timeline">

									<!-- Timeline header -->
									<div class="timeline-header">
										<div class="timeline-header-title bg-success">Now</div>
									</div>

									<div class="timeline-entry">
										<div class="timeline-stat">
											<div class="timeline-icon">
												<img
													src="https://bootdey.com/img/Content/avatar/avatar1.png"
													alt="Profile picture">
											</div>
											<div class="timeline-time">30 Min ago</div>
										</div>
										<div class="timeline-label">
											<p class="mar-no pad-btm">
												<a href="#" class="btn-link text-semibold">Maria J.</a>
												shared an image
											</p>
											<div class="img-holder">
												<img
													src="https://bootdey.com/img/Content/avatar/avatar1.png"
													alt="Image">
											</div>
										</div>
									</div>
									<div class="timeline-entry">
										<div class="timeline-stat">
											<div class="timeline-icon bg-danger">
												<i class="fa fa-building fa-lg"></i>
											</div>
											<div class="timeline-time">2 Hours ago</div>
										</div>
										<div class="timeline-label">
											<h4 class="mar-no pad-btm">
												<a href="#" class="text-danger">Job Meeting</a>
											</h4>
											<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
												sed diam nonummy nibh euismod tincidunt.</p>
										</div>
									</div>
									<div class="timeline-entry">
										<div class="timeline-stat">
											<div class="timeline-icon">
												<img
													src="https://bootdey.com/img/Content/avatar/avatar6.png"
													alt="Profile picture">
											</div>
											<div class="timeline-time">3 Hours ago</div>
										</div>
										<div class="timeline-label">
											<p class="mar-no pad-btm">
												<a href="#" class="btn-link text-semibold">Lisa D.</a>
												commented on <a href="#">The Article</a>
											</p>
											<blockquote class="bq-sm bq-open">Lorem ipsum dolor sit amet,
												consectetuer adipiscing elit, sed diam nonummy nibh euismod
												tincidunt.</blockquote>
										</div>
									</div>
									<div class="timeline-entry">
										<div class="timeline-stat">
											<div class="timeline-icon bg-purple">
												<i class="fa fa-check fa-lg"></i>
											</div>
											<div class="timeline-time">5 Hours ago</div>
										</div>
										<div class="timeline-label">
											<img class="img-xs img-circle"
												src="https://bootdey.com/img/Content/avatar/avatar2.png"
												alt="Profile picture"> <a href="#"
												class="btn-link text-semibold">Bobby Marz</a> followed you.
										</div>
									</div>

									<!-- Timeline header -->
									<div class="timeline-header">
										<div class="timeline-header-title bg-dark">Yesterday</div>
									</div>

									<div class="timeline-entry">
										<div class="timeline-stat">
											<div class="timeline-icon bg-info">
												<i class="fa fa-envelope fa-lg"></i>
											</div>
											<div class="timeline-time">15:45</div>
										</div>
										<div class="timeline-label">
											<h4 class="text-info mar-no pad-btm">Lorem ipsum dolor sit
												amet</h4>
											<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
												sed diam nonummy nibh euismod tincidunt.</p>
										</div>
									</div>
									<div class="timeline-entry">
										<div class="timeline-stat">
											<div class="timeline-icon bg-success">
												<i class="fa fa-thumbs-up fa-lg"></i>
											</div>
											<div class="timeline-time">13:27</div>
										</div>
										<div class="timeline-label">
											<img class="img-xs img-circle"
												src="https://bootdey.com/img/Content/avatar/avatar3.png"
												alt="Profile picture"> <a href="#"
												class="btn-link text-semibold">Michael Both</a> Like <a
												href="#">The Article</a>
										</div>
									</div>
									<div class="timeline-entry">
										<div class="timeline-stat">
											<div class="timeline-icon"></div>
											<div class="timeline-time">11:27</div>
										</div>
										<div class="timeline-label">
											<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
												sed diam nonummy nibh euismod tincidunt.</p>
										</div>
									</div>
								</div>
								<!--===================================================-->
								<!-- End Timeline -->
							</div>
						</div>
					</div>

				</div>
			</div>


		</div>
	</div>

</div>
<script>
// jQuery.noConflict();
$(document).on('click','#follow',function(){
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
			$('.followers-count').text(data);
			if($('#follow').html() == 'Follow'){
				$('#follow').html('Unfollow');
				$('#follow').removeClass('btn-primary');
				$('#follow').addClass('btn-outline-info');	
			}else{
				$('#follow').html('Follow');
				$('#follow').removeClass('btn-outline-info');
				$('#follow').addClass('btn-primary');
			}
		}
	});
});
$(document).on('click','#skill-submit',function(){
	var skill = $('#skill-name').val();
	var level = $('#level').val();
	var id = $(this).attr('data-id');
	var model = $(this).attr('data-key');
	var arr = {
	 	  	id : id,
	    	model : model,
	    	skill : skill,
	    	level : level
	}
	$.ajax({
	    type: 'POST',
        dataType: 'json',
	    data: arr,
		url: '<?= Url::toRoute(['user/add-skill'])?>',
		success: function(result) {
    		$('#add-skill').remove();
    		$('.skill-card').append(data.responseText);
    		$('.skill-card').append('<?php echo  Html::a('<i class="fa fa-plus"></i>',['#'],['class' => 'badge badge-primary','id' => 'add-skill',  'data-toggle'=>"modal", 'data-target'=>"#skillModalCenter"])?>');
    		$('#skillModalCenter').modal('hide');
    		$('#skill-name').val('');
    		$('#level').val('0');
		},
      	complete: function (data) {
    		$('#add-skill').remove();
    		$('.skill-card').append(data.responseText);
    		$('.skill-card').append('<?php echo  Html::a('<i class="fa fa-plus"></i>',['#'],['class' => 'badge badge-primary','id' => 'add-skill',  'data-toggle'=>"modal", 'data-target'=>"#skillModalCenter"])?>');
    		$('#skillModalCenter').modal('hide');
    		$('#skill-name').val('');
    		$('#level').val('0');
      	}
	});
});
</script>

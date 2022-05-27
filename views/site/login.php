<?php
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use app\models\search\Users;
?>
<main class="d-flex w-100">
	<div class="container d-flex flex-column">
		<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
			<div class="d-table-cell align-middle">

				<div class="text-center mt-4">
					<h1 class="h2" style="font-size:4rem;">Welcome back</h1>
					<p class="lead" style="font-size:1.6rem;">Sign in to your account to continue</p>
				</div>

				<div class="card">
					<div class="card-body">
						<div class="m-sm-4">
							<div class="text-center">
							<?php $user = new Users()?>
								<img src="<?= $user->getImageUrl() ?>"
									class="img-fluid rounded-circle" width="132" height="132" />
							</div>
                            <?php $form = ActiveForm::begin([
                                'id' => 'login-form',
                                // 'layout' => 'horizontal',
                                'fieldConfig' => [
                                    'template' => "{label}\n{input}\n{error}",
                                    'labelOptions' => [
                                        'class' => 'form-label'
                                    ],
                                    'inputOptions' => [
                                        'class' => 'form-control form-control-lg'
                                    ],
                                    'errorOptions' => [
                                        'class' => 'col-lg-7 invalid-feedback'
                                    ]
                                ]
                            ]);
                            ?>

							<!-- 											<label class="form-label">Email</label> -->
							<!-- 											<input class="form-control form-control-lg" type="email" name="email" placeholder="Enter your email" /> -->
							<?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>


							<div class="mb-3">
								<!-- 											<label class="form-label">Password</label> -->
								<!-- 											<input class="form-control form-control-lg" type="password" name="password" placeholder="Enter your password" /> -->
        						<?= $form->field($model, 'password')->passwordInput() ?>

    							<small> 
    								<a href="index.html" class="float-right">Forgot password?</a>
    							</small>
    						</div>
    						<div>
											<?=$form->field($model, 'rememberMe')->checkbox(['template' => "<div class=\"offset-lg-1 col-lg-4 ml-n1 custom-control custom-checkbox\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>"])?>
										</div>
							<div class="text-center mt-3">
								<!-- 											<a href="index.html" class="btn btn-lg btn-primary">Sign in</a> -->
								<!-- <button type="submit" class="btn btn-lg btn-primary">Sign in</button> -->
								<div class="form-group">
									<div class="offset-lg-1 col-lg-11">
                                        <?= Html::submitButton('Sign In', ['class' => 'btn btn-primary col-5 p-3 m-2', 'name' => 'login-button']) ?>
                                        <?= Html::a('Sign Up',['site/sign-up'], ['class' => 'btn btn-secondary login-btns col-5 p-3 m-2']) ?>
                                    </div>
								</div>
							</div>
							<?php ActiveForm::end(); ?>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</main>
<!-- /.login-card-body -->


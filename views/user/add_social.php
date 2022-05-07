<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\debug\models\Router;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>
<main class="d-flex w-100 d-flex justify-content-center">
	<div class="container d-flex flex-column">
		<div class="col-sm-11 mx-auto d-table h-100">
			<div class="d-table-cell align-middle">

				<?php
    $form = ActiveForm::begin([
        'id' => 'add_social',
        'options' => [
            'enctype' => 'multipart/form-data'
        ],
        'fieldConfig' => [
            'template' => "{input} {error}",
            'labelOptions' => [
                'class' => 'col-form-label mr-lg-3'
            ],
            'inputOptions' => [
                'class' => 'form-control'
            ],
            'errorOptions' => [
                'class' => 'invalid-feedback'
            ]
        ]
    ]);
    ?>
				<div class="card">
					<div class="card-body">
						<div class="col-12">
							<div class="m-sm-4">
								<ul class="list-group list-group-flush">
									<li
										class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
										<h3 class="mb-0">Social Links</h3>
                  </li>
									<li
										class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
										<h6 class="mb-0">
											<svg xmlns="http://www.w3.org/2000/svg" width="24"
												height="24" viewBox="0 0 24 24" fill="none"
												stroke="currentColor" stroke-width="2"
												stroke-linecap="round" stroke-linejoin="round"
												class="feather feather-globe mr-2 icon-inline">
												<circle cx="12" cy="12" r="10"></circle>
												<line x1="2" y1="12" x2="22" y2="12"></line>
												<path
													d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
											Website
										</h6> <span class="text-secondary"><?= $form->field($model, 'link')->textInput(['maxlength' => true, 'id'=>"website"]) ?></span>
									</li>
									<li
										class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
										<h6 class="mb-0">
											<svg xmlns="http://www.w3.org/2000/svg" width="24"
												height="24" viewBox="0 0 24 24" fill="none"
												stroke="currentColor" stroke-width="2"
												stroke-linecap="round" stroke-linejoin="round"
												class="feather feather-github mr-2 icon-inline">
												<path
													d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg>
											Github
										</h6> <span class="text-secondary"><?= $form->field($model, 'link')->textInput(['maxlength' => true, 'id'=>"github"]) ?></span>
									</li>
									<li
										class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
										<h6 class="mb-0">
											<svg xmlns="http://www.w3.org/2000/svg" width="24"
												height="24" viewBox="0 0 24 24" fill="none"
												stroke="currentColor" stroke-width="2"
												stroke-linecap="round" stroke-linejoin="round"
												class="feather feather-twitter mr-2 icon-inline text-info">
												<path
													d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>
											Twitter
										</h6> <span class="text-secondary"><?= $form->field($model, 'link')->textInput(['maxlength' => true, 'id'=>"twitter"]) ?></span>
									</li>
									<li
										class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
										<h6 class="mb-0">
											<svg xmlns="http://www.w3.org/2000/svg" width="24"
												height="24" viewBox="0 0 24 24" fill="none"
												stroke="currentColor" stroke-width="2"
												stroke-linecap="round" stroke-linejoin="round"
												class="feather feather-instagram mr-2 icon-inline text-danger">
												<rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
												<path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
												<line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
											Instagram
										</h6> <span class="text-secondary"><?= $form->field($model, 'link')->textInput(['maxlength' => true, 'id'=>"instagram"]) ?></span>
									</li>
									<li
										class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
										<h6 class="mb-0">
											<svg xmlns="http://www.w3.org/2000/svg" width="24"
												height="24" viewBox="0 0 24 24" fill="none"
												stroke="currentColor" stroke-width="2"
												stroke-linecap="round" stroke-linejoin="round"
												class="feather feather-facebook mr-2 icon-inline text-primary">
												<path
													d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
											Facebook
										</h6> <span class="text-secondary"><?= $form->field($model, 'link')->textInput(['maxlength' => true, 'id'=>"facebook"]) ?></span>
									</li>
								</ul>

								<div class="text-center mt-3">

									<div class="form-group">
                                    <?= Html::button(Yii::t('app', 'Update'), ['class' => 'btn btn-success login-btns','id' => 'submit']) ?>
                                </div>
								</div>
                        <?php ActiveForm::end(); ?>
					</div>
						</div>
					</div>
				</div>
			</div>

</main>
<script type="text/javascript">
function showPreview(event){
  if(event.target.files.length > 0){
    var src = URL.createObjectURL(event.target.files[0]);
    var preview = document.getElementById("file-ip-1-preview");
    preview.src = src;
  }
}
$(document).on('click','#submit',function(){
	var web = $('#website').val();
	var git = $('#github').val();
	var twit = $('#twitter').val();
	var insta = $('#instagram').val();
	var fb = $('#facebook').val();
	var arr = {
	 	  	website : web,
	    	github : git,
	    	twitter : twit,
	    	instagram : insta,
	    	facebook : fb
	}
	$.ajax({
	    type: 'POST',
        dataType: 'json',
	    data: arr,
		url: '<?= Url::toRoute(['user/add-social','user_id' => $user_id])?>',
		success: function(data) {
			location.window.href = '<?= Url::toRoute(['user/view','id' => $user_id])?>';
		}
	});
});
</script>

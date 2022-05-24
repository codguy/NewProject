<?php
use yii\widgets\ListView;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;
use app\models\Feed;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<style>
.social-feed-box {
  /*padding: 15px;*/
  border: 1px solid #e7eaec;
  background: #fff;
  margin-bottom: 15px;
  border-radius: 10px;
  border: 1px solid silver;
}
.article .social-feed-box p {
  font-size: 13px;
  line-height: 18px;
} 
.social-avatar {
  padding: 15px 15px 0 15px;
}
.social-comment .social-comment {
  margin-left: 10px;
}
.social-avatar img {
  height: 50px;
  width: 50px;
  margin-right: 10px;
}
.social-avatar .media-body a {
  font-size: 14px;
  display: block;
}
.social-body {
  padding: 15px;
}
.social-body img {
  margin-bottom: 10px;
}
.social-footer {
  border-top: 1px solid #e7eaec;
  padding: 10px 15px;
  background: #f9f9f9;
}
.social-comment:first-child {
  margin-top: 0;
}
.social-comment {
  margin-top: 15px;
}
.social-comment textarea {
  font-size: 12px;
}


.form-control, .single-line {
    background-color: #FFFFFF;
    background-image: none;
    border: 1px solid #e5e6e7;
    border-radius: 1px;
    color: inherit;
    display: block;
    padding: 6px 12px;
    transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
    width: 100%;
    font-size: 14px;
}

.ibox {
  clear: both;
  margin-bottom: 25px;
  margin-top: 0;
  padding: 0;
}
.ibox.collapsed .ibox-content {
  display: none;
}
.ibox.collapsed .fa.fa-chevron-up:before {
  content: "\f078";
}
.ibox.collapsed .fa.fa-chevron-down:before {
  content: "\f077";
}
.ibox:after,
.ibox:before {
  display: table;
}
.ibox-title {
  -moz-border-bottom-colors: none;
  -moz-border-left-colors: none;
  -moz-border-right-colors: none;
  -moz-border-top-colors: none;
  background-color: #ffffff;
  border-color: #e7eaec;
  border-image: none;
  border-style: solid solid none;
  border-width: 3px 0 0;
  color: inherit;
  margin-bottom: 0;
  padding: 14px 15px 7px;
  min-height: 48px;
}
.ibox-content {
  background-color: #ffffff;
  color: inherit;
  padding: 15px 20px 20px 20px;
  border-color: #e7eaec;
  border-image: none;
  border-style: solid solid none;
  border-width: 1px 0;
}
.ibox-footer {
  color: inherit;
  border-top: 1px solid #e7eaec;
  font-size: 90%;
  background: #ffffff;
  padding: 10px 15px;
}
</style>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container">
<div class="col-md-10 mt-5">
<?php
    $form = ActiveForm::begin([
        'id' => 'signup-form',
        'options' => [
            'enctype' => 'multipart/form-data',
            'class' => "comment-area-box mb-3 card",
            'style' => "border-radius:10px;border:2px solid silver;"
        ],
        'action' => ['user/create-feed'],
        'method' => 'POST',
        'fieldConfig' => [
            'template' => "{input}\n{error}",
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
	<!-- comment box -->
    <h3 class="m-3">Create feed</h3>
    	<span class="input-icon m-2">
            <!-- <input type="text" class="form-control feed-title" placeholder="Add title..."> -->
            <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'class' => 'form-control feed-title', 'placeholder' => "Add title..."]) ?>
        </span>
        <span class="input-icon m-2">
            <!-- <textarea rows="3" class="form-control feed-text" placeholder="Write something..."></textarea> -->
            <?= $form->field($model, 'desciption')->textarea(['rows'=>"3", 'class'=>"form-control feed-text", 'placeholder'=>"Write something..."]) ?>
            <div class="comment-area-btn">
                <div class="float-end">
                    <?= Html::submitButton(Yii::t('app', 'Post'), ['class' => 'btn btn-sm btn-dark waves-effect waves-light float-right']) ?>
                </div>
                <div>
                    <a href="#" class="btn btn-sm btn-light text-black-50"><i class="far fa-user"></i></a>
                    <a href="#" class="btn btn-sm btn-light text-black-50"><i class="fa fa-map-marker"></i></a>
                    <a href="#" class="btn btn-sm btn-light text-black-50" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-camera"></i></a>
                    <a href="#" class="btn btn-sm btn-light text-black-50"><i class="far fa-smile"></i></a>
                </div>
            </div>
        </span>
    <!-- end comment box -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
Uploading a new photo</h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
            </div>
            <div class="modal-body">
                <p class="body-desc"> 
It will be easier for your friends to recognize you if you upload your real photo. You can upload the image in JPG, GIF or PNG format. </p>
                <div class="photo-input">
                	<center>
            			<img src='' alt="Charles Hall" id="file-ip-1-preview" style="display:none; max-height:450px; max-width:80%;"/> 
                		<?= $form->field($model, 'image')->fileInput(['onchange'=>"showPreview(event);", 'id'=>"file-ip-1", 'class'=>'form-input d-none' ])?>
                		<label class="btn btn-sm btn-primary text-center" for="file-ip-1">
                			 Select a file 
            			</label> 
        			</center> 
    			</div>
            </div>
            <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Upload</button>
            </div>
        </div>
    </div>
</div>

    <?php ActiveForm::end(); ?>
    <?php
    
    $query = Feed::find();
    
    // add conditions that should always apply here
    
    $dataProvider = new ActiveDataProvider([
    'query' => $query,
    'sort' => [
        'defaultOrder' => [
            'created_on' => SORT_DESC,
        ]
    ],
    ]);
    
    
    echo ListView::widget([
        'dataProvider' => $dataProvider,
        'layout' => '{items}',
        'itemView' => '_feed'  
    ])?>
</div>
</div>
<script>
$(document).on('click', '#submit-feed', function(){
	var msg = $('.feed-text').val();
	var title = $('.feed-title').val();
	var image = $('#file-ip-1').val();
	var arr = {
		message: msg,
		title: title,
		image: image
	}
	
	console.log(arr);
	/* $.ajax({
	    type: 'POST',
        dataType: 'json',
	    data: arr,
		url: '<?= Url::toRoute(['user/create-feed'])?>',
		success: function(data) {
			location.reload();
		}
	}); */
});

function showPreview(event){
  if(event.target.files.length > 0){
    var src = URL.createObjectURL(event.target.files[0]);
    var preview = document.getElementById("file-ip-1-preview");
    preview.src = src;
    preview.style.display = "block";
  }
}
</script>
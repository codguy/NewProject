<?php
use yii\widgets\ListView;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;
use app\models\Feed;
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

	<!-- comment box -->
    <form action="#" class="comment-area-box mb-3 card" style="border-radius:10px;border:2px solid silver;">
    	<span class="input-icon m-2">
            <input type="text" class="form-control feed-title" placeholder="Add title...">
        </span>
        <span class="input-icon m-2">
            <textarea rows="3" class="form-control feed-text" placeholder="Write something..."></textarea>
            <div class="comment-area-btn">
                <div class="float-end">
                    <button type="submit" class="btn btn-sm btn-dark waves-effect waves-light float-right" id="submit-feed">Post</button>
                </div>
                <div>
                    <a href="#" class="btn btn-sm btn-light text-black-50"><i class="far fa-user"></i></a>
                    <a href="#" class="btn btn-sm btn-light text-black-50"><i class="fa fa-map-marker"></i></a>
                    <a href="#" class="btn btn-sm btn-light text-black-50"><i class="fa fa-camera"></i></a>
                    <a href="#" class="btn btn-sm btn-light text-black-50"><i class="far fa-smile"></i></a>
                </div>
            </div>
        </span>
    </form>
    <!-- end comment box -->
    
    <?php
    
    $query = Feed::find();
    
    // add conditions that should always apply here
    
    $dataProvider = new ActiveDataProvider([
    'query' => $query,
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
	var arr = {
		message: msg,
		title: title,
	}
	$.ajax({
	    type: 'POST',
        dataType: 'json',
	    data: arr,
		url: '<?= Url::toRoute(['user/create-feed'])?>',
		success: function(data) {
			location.reload();
		}
	});
});
</script>
<?php

/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;

\hail812\adminlte3\assets\FontAwesomeAsset::register($this);
\hail812\adminlte3\assets\AdminLteAsset::register($this);
$this->registerCssFile('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback');

$assetDir = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
<meta charset="<?= Yii::$app->charset ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
    body {
    	background: rgb(29,222,110);
        background: radial-gradient(circle, rgba(29,222,110,1) 0%, rgba(46,142,217,1) 62%); 
    	height: auto;
    	color: white;
    }
    .card {
        color:black;
    	background-color: white;
    	box-shadow: 5px 5px 15px -5px black;
    }
    .btn.btn-primary.login-btns {
    	padding: 14px 110px;
    	font-size: 1.3em;
    	margin-top: 20px;
    }
    </style>
</head>
<body class="hold-transition sidebar-mini">
<?php $this->beginBody() ?>

<div class="content">
        <?= $content ?>
		<!-- /.container-fluid -->
	</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
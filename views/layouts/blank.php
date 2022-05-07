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
    	background-image: linear-gradient(to right bottom, rgb(6, 85, 187), rgb(0, 133, 231), rgb(0, 174, 224), rgb(0, 208, 172), rgb(18, 235, 93));
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
<body class="hold-transition sidebar-mini" style=" background-image: linear-gradient(to right bottom, #0655bb, #0085e7, #00aee0, #00d0ac, #12eb5d);">
<?php $this->beginBody() ?>

<div class="content">
        <?= $content ?>
		<!-- /.container-fluid -->
	</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
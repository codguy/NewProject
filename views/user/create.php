<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

// $this->title = Yii::t('app', 'Create Users');
// $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<nav aria-label="breadcrumb" class="main-breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><?= Html::a('Home', ['site/index']) ?></li>
		<li class="breadcrumb-item"><?= Html::a('Users', ['index']) ?></li>
		<li class="breadcrumb-item active" aria-current="page">Create</li>
	</ol>
</nav>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

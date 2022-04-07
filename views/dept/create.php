<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Dept */

$this->title = Yii::t('app', 'Create Dept');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Depts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dept-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\User;
use app\models\Users;

/* @var $this yii\web\View */
/* @var $model app\models\Dept */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dept-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'field')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'school_name')->textInput(['maxlength' => true, 'value' => 'University School of ']) ?>

    <?= $form->field($model, 'hod_id')->dropDownList(ArrayHelper::map(Users::findAll(['roll_id' => Users::ROLE_MANAGER]), 'id', 'username')) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

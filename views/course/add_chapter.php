<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Course */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="course-form">

    <?php

    $form = ActiveForm::begin([
        'action' => [
            'course/add-chapter',
            'id' => $id
        ],
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
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

    
	<div class="col-8 float-left">
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    </div><div class="col-4 float-left">
        <?= $form->field($model, 'dificulty')->textInput(['type'=>'range', 'min' => 1, 'max' => 3]) ?>
    </div>

    <?=$form->field($model, 'desciption')->widget(CKEditor::className(), ['options' => ['rows' => 6,'class' => 'from-control'],'preset' => 'full',
        
    ]);?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
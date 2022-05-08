<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

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

    <?=$form->field($model, 'desciption')->widget(CKEditor::className(), ['options' => ['rows' => 6,'class' => 'from-control'],'preset' => 'advanced',
        'clientOptions' => [
            'toolbar' => [
                [
                    'name' => 'row1',
                    'items' => [
                        'Source', '-',
                        'Bold', 'Italic', 'Underline', 'Strike', '-',
                        'Subscript', 'Superscript', 'RemoveFormat', '-',
                        'TextColor', 'BGColor', '-',
                        'NumberedList', 'BulletedList', '-',
                        'Outdent', 'Indent', '-', 'Blockquote', '-',
                        'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', 'list', 'indent', 'blocks', 'align', 'bidi', '-',
                        'Link', 'Unlink', 'Anchor', '-',
                        'ShowBlocks', 'Maximize',
                        //'pbckcode',
                    ],
                ],
                [
                    'name' => 'row2',
                    'items' => [
                        'Image', 'Table', 'HorizontalRule', 'SpecialChar', 'Iframe', '-',
                        'NewPage', 'Print', 'Templates', '-',
                        'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-',
                        'Undo', 'Redo', '-',
                        'Find', 'SelectAll', 'Format', 'Font', 'FontSize',
                        'base64image',
                    ],
                ],
            ],
        ],
    ]);?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
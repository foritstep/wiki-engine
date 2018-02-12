<?php

use franciscomaya\sceditor\SCEditor;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Page */
/* @var $form yii\widgets\ActiveForm */
?>

<script>let path_action_exist ='<?= Url::to(['page/exist', 'id' => '']) ?>';</script>

<div class="page-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->widget(SCEditor::className(), [
        'options' => ['rows' => 15],
        'clientOptions' => [
            'plugins' => 'bbcode',
            'width' => '100%',
            'style' => 'css/WikiPages.css',
        ]
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

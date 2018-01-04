<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\EditorPassword */

$this->title = 'Change password';
$this->params['breadcrumbs'][] = ['label' => 'Editors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="editor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="editor-form">
        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'current')->passwordInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'new')->passwordInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'confirm')->passwordInput(['maxlength' => true]) ?>
        <div class="form-group">
            <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div>

</div>

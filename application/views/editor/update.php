<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Editor */

$this->title = 'Update Editor: ' . $model->nick;
$this->params['breadcrumbs'][] = ['label' => 'Editors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nick, 'url' => ['view', 'id' => $model->nick]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="editor-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

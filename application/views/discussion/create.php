<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Discussion */

$this->title = 'Create Discussion';
$this->params['breadcrumbs'][] = ['label' => 'Discussions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="discussion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

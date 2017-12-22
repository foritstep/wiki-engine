<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Discussion */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Discussions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="discussion-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Page', Url::to(['page/view', 'id' => $model->title]), ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->title], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->title], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <main>
        <?= $model->purifiedContent() ?>
    </main>

</div>

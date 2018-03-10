<?php

$this->title = 'FIXME';

?>

<div class="form-group image-container">
    <div>
        <img class="image-full-preview" src="<?= \yii\helpers\Html::encode($model) ?>"/>
    </div>
    <div>
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <div class="horizontal-separator"></div>
            <input class="form-control " value="<?= \yii\helpers\Html::encode($model) ?>" readonly />
        </div>
    </div>
</div>
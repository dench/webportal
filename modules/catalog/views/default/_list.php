<?php

use yii\helpers\Html;
use yii\helpers\StringHelper;

?>

<div class="post-item row">
    <div class="post-item-img col-md-3">
        <a href="#" class="thumbnail"><i></i></a>
    </div>
    <div class="post-item-content col-md-9">
        <h3><?= Html::a(Html::encode($model->name), ['/catalog/default/view', 'slug' => $model->slug, 'id' => $model->id]) ?></h3>
    </div>
</div>
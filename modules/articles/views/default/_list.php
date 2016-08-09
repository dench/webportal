<?php

use yii\helpers\Html;
use yii\helpers\StringHelper;

?>

<div class="post-item row">
    <div class="post-item-img col-md-3">
        <a href="#" class="thumbnail"><i></i></a>
    </div>
    <div class="post-item-content col-md-9">
        <div class="post-item-date"><?= $model->created_at ?></div>
        <h3><?= Html::a(Html::encode($model->name), ['/articles/default/view', 'slug' => $model->slug]) ?></h3>
        <p class="post-item-text">
            <?= StringHelper::truncate($model->text, 150, '...'); ?>
        </p>
    </div>
</div>
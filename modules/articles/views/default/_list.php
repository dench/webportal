<?php
use yii\helpers\Html;
?>

<div class="news-item">
    <?= Html::a(Html::encode($model->name), ['/articles/default/view', 'slug' => $model->slug]) ?>
</div>
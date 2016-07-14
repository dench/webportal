<?php

use app\modules\articles\models\ArticleCategory;
use app\widgets\TreeNav;
use yii\widgets\ListView;

/** @var $this yii\web\View */
/** @var $tree ArticleCategory */
/** @var $category ArticleCategory */

// TODO: Сделать модуль хлебных крошок
// TODO: Автоматическая подстановка title
if ($category->parent_id) {
    if ($category->parent->parent_id) {
        $this->params['breadcrumbs'][] = ['label' => $category->parent->parent->name, 'url' => ['/articles/default/index', 'slug' => $category->parent->parent->slug]];
        $this->title .= $category->parent->parent->name . ' - ';
    }
    $this->params['breadcrumbs'][] = ['label' => $category->parent->name, 'url' => ['/articles/default/index', 'slug' => $category->parent->slug]];
    $this->title .= $category->parent->name . ' - ';
}
$this->params['breadcrumbs'][] = $category->name;
$this->title .= $category->name;
?>
<div class="col-md-9">
    <?php
    echo ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_list',
    ]);
    ?>
</div>
<div class="col-md-3">
    <?php

    // TODO: Сохранять в кеше
    echo TreeNav::widget([
        'tree' => $tree,
        'url' => '/articles/default/index'
    ]);

    ?>
</div>

<?php

use app\modules\catalog\models\ProductCategory;
use app\widgets\TreeNav;
use yii\widgets\ListView;

/** @var $tree ProductCategory */
/** @var $category ProductCategory */

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

$this->registerMetaTag([
    'name' => 'description',
    'content' => $category->description
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => $category->keywords
]);

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
        'url' => '/catalog/default/index',
        'icons' => [
            2 => 'fa fa-home',
            14 => 'fa fa-home'
        ]
    ]);

    ?>
</div>
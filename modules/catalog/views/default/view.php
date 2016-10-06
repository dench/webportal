<?php

/** @var $category \app\modules\catalog\models\ProductCategory */
/** @var $model \app\modules\catalog\models\Product */

if ($category->parent_id) {
    if ($category->parent->parent_id) {
        $this->params['breadcrumbs'][] = ['label' => $category->parent->parent->name, 'url' => ['/catalog/default/index', 'slug' => $category->parent->parent->slug]];
        $this->title .= $category->parent->parent->name . ' - ';
    }
    $this->params['breadcrumbs'][] = ['label' => $category->parent->name, 'url' => ['/catalog/default/index', 'slug' => $category->parent->slug]];
    $this->title .= $category->parent->name . ' - ';
}
$this->params['breadcrumbs'][] = ['label' => $category->name, 'url' => ['/catalog/default/index', 'slug' => $category->slug]];

// TODO: MetaTag Behavior
$this->title = $model->name;

?>

<h1><?= $model->name ?></h1>

<h2><?= $model->price ?></h2>
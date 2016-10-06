<?php

/** @var $category app\modules\articles\models\ArticleCategory */
/** @var $model \app\modules\articles\models\Article */

if ($category->parent_id) {
    if ($category->parent->parent_id) {
        $this->params['breadcrumbs'][] = ['label' => $category->parent->parent->name, 'url' => ['/articles/default/index', 'slug' => $category->parent->parent->slug]];
        $this->title .= $category->parent->parent->name . ' - ';
    }
    $this->params['breadcrumbs'][] = ['label' => $category->parent->name, 'url' => ['/articles/default/index', 'slug' => $category->parent->slug]];
    $this->title .= $category->parent->name . ' - ';
}
$this->params['breadcrumbs'][] = ['label' => $category->name, 'url' => ['/articles/default/index', 'slug' => $category->slug]];

// TODO: MetaTag Behavior
$this->title = $model->title;

$this->registerMetaTag([
    'name' => 'description',
    'content' => $model->description
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => $model->keywords
]);

echo \app\widgets\Page::widget([
    'name' => $model->name,
    'date' => $model->date,
    'text' => $model->text
]);
<?php

if ($category->parent_id) {
    if ($category->parent->parent_id) {
        $this->params['breadcrumbs'][] = ['label' => $category->parent->parent->name, 'url' => ['/articles/default/index', 'slug' => $category->parent->parent->slug]];
        $this->title .= $category->parent->parent->name . ' - ';
    }
    $this->params['breadcrumbs'][] = ['label' => $category->parent->name, 'url' => ['/articles/default/index', 'slug' => $category->parent->slug]];
    $this->title .= $category->parent->name . ' - ';
}
$this->params['breadcrumbs'][] = ['label' => $category->name, 'url' => ['/articles/default/index', 'slug' => $category->slug]];
$this->title .= $category->name;

echo $model->name;
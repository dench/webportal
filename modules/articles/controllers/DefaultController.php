<?php

namespace app\modules\articles\controllers;

use app\modules\articles\models\Article;
use app\modules\articles\models\ArticleCategory;
use yii\web\Controller;

/**
 * Default controller for the `articles` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $category = ArticleCategory::findAll(['enabled' => 1]);
        
        return $this->render('index', [
            'category' => $category
        ]);
    }

    public function actionView($slug)
    {
        $model = Article::findOne(['slug' => $slug]);
        
        return $this->render('view', [
            'model' => $model
        ]);
    }

    public function actionCategory($slug)
    {
        $model = ArticleCategory::findOne(['slug' => $slug]);

        return $this->render('category', [
            'model' => $model
        ]);
    }
}

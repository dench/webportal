<?php

namespace app\modules\articles\controllers;

use app\modules\articles\helpers\ArticleCategoryHelper;
use app\modules\articles\models\Article;
use app\modules\articles\models\ArticleCategory;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `articles` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex($slug = null)
    {
        $category = $this->findCategory(['slug' => $slug]);

        $dataProvider = new ActiveDataProvider([
            'query' => Article::find()->where(['enabled' => 1])->filterWhere(['category_id' => ArticleCategoryHelper::familyIds($category->id)])
        ]);

        return $this->render('index', [
            'tree' => ArticleCategoryHelper::tree(1),
            'category' => $category,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionView($slug)
    {
        $model = $this->findArticle($slug);

        $category = $this->findCategory($model->category_id);
        
        return $this->render('view', [
            'model' => $model,
            'category' => $category
        ]);
    }

    protected function findArticle($slug)
    {
        if (($model = Article::findOne(['slug' => $slug])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findCategory($param)
    {
        if (($model = ArticleCategory::findOne($param)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

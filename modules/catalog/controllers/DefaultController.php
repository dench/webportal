<?php

namespace app\modules\catalog\controllers;

use app\modules\catalog\helpers\ProductCategoryHelper;
use app\modules\catalog\models\Product;
use app\modules\catalog\models\ProductCategory;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `catalog` module
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
            'query' => Product::find()->where(['enabled' => 1])->filterWhere(['category_id' => ProductCategoryHelper::familyIds($category->id)])
        ]);

        return $this->render('index', [
            'tree' => ProductCategoryHelper::tree(1),
            'category' => $category,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionView($slug, $id)
    {
        $model = $this->findProduct($slug, $id);

        $category = $this->findCategory($model->category_id);

        return $this->render('view', [
            'model' => $model,
            'category' => $category
        ]);
    }

    protected function findProduct($slug, $id)
    {
        if (($model = Product::findOne(['id' => $id, 'slug' => $slug])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findCategory($param)
    {
        if (($model = ProductCategory::findOne($param)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

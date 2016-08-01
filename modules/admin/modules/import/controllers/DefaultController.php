<?php

namespace app\modules\admin\modules\import\controllers;

use app\modules\admin\modules\import\convert\HotlineConvert;
use app\modules\admin\modules\import\models\ImportCategory;
use app\modules\admin\modules\import\models\ImportProduct;
use app\modules\admin\modules\import\models\ImportUpload;
use app\modules\admin\modules\import\models\ImportVendor;
use app\modules\catalog\models\Product;
use app\modules\catalog\models\Vendor;
use Yii;
use app\modules\admin\modules\import\models\Import;
use app\modules\admin\modules\import\models\ImportSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * DefaultController implements the CRUD actions for Import model.
 */
class DefaultController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Import models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ImportSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Import model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        $error = $this->parseXml($model);

        if (!empty($error)) {
            print_r($error);
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Import model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Import();

        $upload = new ImportUpload();

        if (Yii::$app->request->isPost) {
            $upload->xmlFile = UploadedFile::getInstance($upload, 'xmlFile');
            if ($upload->upload()) {
                $model->filename = $upload->filename;
                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    ImportUpload::delete($upload->filename);
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
            'upload' => $upload
        ]);
    }

    /**
     * Updates an existing Import model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Import model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Import model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Import the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Import::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function parseXml($param)
    {
        $file = ImportUpload::read($param['filename']);
        $user_id = $param['user_id'];

        $error = [];

        $xml = HotlineConvert::run($file);

        foreach ($xml['categories'] as $x) {
            $import = ImportCategory::findOne(['remote_id' => $x['remote_id'], 'user_id' => $user_id]);
            if (empty($import)) {
                $import = new ImportCategory();
            }
            $import->attributes = ArrayHelper::merge($import->attributes, $x);
            if (!$import->save()) {
                $error['categories'] = $import->errors;
                continue;
            }
        }

        foreach ($xml['items'] as $x) {
            $vendor = ImportVendor::findOne(['name' => $x['vendor'], 'user_id' => $user_id]);
            if (empty($vendor)) {
                $vendor = new ImportVendor();
            }
            $vendor->name = $x['vendor'];
            if (!$vendor->save()) {
                $error['vendor'] = $vendor->errors;
                continue;
            }

            $import = ImportProduct::findOne(['remote_id' => $x['remote_id'], 'user_id' => $user_id]);
            if (empty($import)) {
                $import = new ImportProduct();
            }
            $import->attributes = ArrayHelper::merge($import->attributes, $x);
            $import->vendor_id = $vendor->id;
            if (!$import->save()) {
                $error['product'] = $import->errors;
                continue;
            }
        }

        return $error;
    }
}

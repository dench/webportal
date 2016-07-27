<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\modules\import\models\Import */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Import',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Imports'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Редактировать');
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>

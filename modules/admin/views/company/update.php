<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\company\models\Company */
/* @var $contacts app\modules\company\models\CompanyContact[] */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Company',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Companies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>

<?= $this->render('_form', [
    'model' => $model,
    'contacts' => $contacts,
]) ?>

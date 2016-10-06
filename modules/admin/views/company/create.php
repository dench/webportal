<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\company\models\Company */
/* @var $contact app\modules\company\models\CompanyContact[] */

$this->title = Yii::t('app', 'Create Company');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Companies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_form', [
    'model' => $model,
    'contact' => $contact,
]) ?>
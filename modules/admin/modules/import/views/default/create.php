<?php

/* @var $this yii\web\View */
/* @var $model app\modules\admin\modules\import\models\Import */
/* @var $upload app\modules\admin\modules\import\models\ImportUpload */

$this->title = Yii::t('app', 'Импортировать');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Импортирование XML'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_form', [
    'model' => $model,
    'upload' => $upload
]) ?>

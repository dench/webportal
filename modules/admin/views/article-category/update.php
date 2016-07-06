<?php

use app\modules\admin\widgets\Box;

/* @var $this yii\web\View */
/* @var $model app\modules\article\models\ArticleCategory */

$this->title = Yii::t('app', 'Редактирование');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Категории статей'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Редактирование');
?>

<?php Box::begin(); ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

<?php Box::end(); ?>

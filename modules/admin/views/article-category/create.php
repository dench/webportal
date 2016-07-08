<?php

use app\modules\admin\widgets\Box;


/* @var $this yii\web\View */
/* @var $model \app\modules\articles\models\ArticleCategory */

$this->title = Yii::t('app', 'Создание категории');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Категории статей'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php Box::begin(); ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

<?php Box::end(); ?>

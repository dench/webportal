<?php

use app\modules\admin\widgets\Box;


/* @var $this yii\web\View */
/* @var $model app\modules\article\models\ArticleCategory */

$this->title = Yii::t('app', 'Create Article Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Article Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php Box::begin(); ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

<?php Box::end(); ?>

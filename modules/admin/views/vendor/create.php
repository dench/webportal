<?php

use app\modules\admin\widgets\Box;

/* @var $this yii\web\View */
/* @var $model app\modules\catalog\models\Vendor */

$this->title = Yii::t('app', 'Создание производитея');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Производители'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php Box::begin(); ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

<?php Box::end(); ?>

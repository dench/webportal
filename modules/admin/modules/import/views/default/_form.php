<?php

use app\modules\admin\modules\import\models\ImportFormat;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\modules\import\models\Import */
/* @var $upload app\modules\admin\modules\import\models\ImportUpload */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'format_id')->dropDownList(ImportFormat::list(), ['prompt' => Yii::t('app', 'Выберите')]) ?>

<?= $form->field($upload, 'xmlFile')->fileInput(['accept' => 'application/xml, text/xml']) ?>

<div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Загрузить') : Yii::t('app', 'Сохранить'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>

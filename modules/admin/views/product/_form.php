<?php

use app\modules\catalog\helpers\ProductCategoryHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\catalog\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'category_id')->dropDownList(ProductCategoryHelper::list(0, null)) ?>

<?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'vendor_id')->textInput() ?>

<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

<?= $form->field($model, 'price')->textInput() ?>

<?= $form->field($model, 'oldprice')->textInput() ?>

<?= $form->field($model, 'stock')->textInput() ?>

<?= $form->field($model, 'guarantee')->textInput() ?>

<?= $form->field($model, 'enabled')->textInput() ?>

<div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Создать') : Yii::t('app', 'Сохранить'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>

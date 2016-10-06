<?php

use app\modules\catalog\helpers\ProductCategoryHelper;
use app\modules\catalog\helpers\VendorHelper;
use app\modules\catalog\models\Stock;
use app\modules\catalog\models\Vendor;
use dosamigos\ckeditor\CKEditor;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\catalog\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'category_id')->dropDownList(ProductCategoryHelper::list(0, null)) ?>

<?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

< ?= $form->field($model, 'vendor_id')->hiddenInput()->label(false); ?>

<?= $form->field($model, 'vendor_id')->textInput(); ?>

<?= $form->field($model, 'vendor')->widget(\yii\jui\AutoComplete::classname(), [
    'options' =>  [
        'class' => 'form-control'
    ],
    'clientOptions' => [
        'source' => Vendor::find()->select(['id', 'name AS label'])->where(['enabled' => 1])->asArray()->all(),
    ],
]) ?>

<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'description')->widget(CKEditor::className(), [
    'options' => ['rows' => 10],
]) ?>

<?= $form->field($model, 'price')->textInput() ?>

<?= $form->field($model, 'oldprice')->textInput() ?>

<?= $form->field($model, 'stock_id')->dropDownList(Stock::list()) ?>

<?= $form->field($model, 'guarantee')->textInput() ?>

<?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'enabled')->checkbox() ?>

<div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Создать') : Yii::t('app', 'Сохранить'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>

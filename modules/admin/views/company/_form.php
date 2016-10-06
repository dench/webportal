<?php

use app\modules\catalog\helpers\ProductCategoryHelper;
use kartik\depdrop\DepDrop;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\company\models\Company */
/* @var $form yii\widgets\ActiveForm */
/* @var $contacts app\modules\company\models\CompanyContact[] */

$js = <<<JS
$('#addcat').click(function(){
    var id1 = $('#cat_id1');
    var id2 = $('#cat_id2');
    var id = 0;
    var name = '';
    if (!id2.val()) {
        id = id1.val();
        name = id1.find(':checked').text();
    } else {
        id = id2.val();
        name = id2.find(':checked').text();
    }
    var tpl = '<li class="list-group-item list-usercat">';
    tpl += '<i class="fa fa-times pull-right btn btn-danger"></i>';
    tpl += '<input type="hidden" name="Category" value="' + id + '">';
    tpl += '<h4>' + name + '</h4>';
    tpl += '</li>';
    $('#cat-group').append(tpl);
});
JS;

$this->registerJs($js);

?>

<div class="company-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <div class="row">
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-body">
                    <?= $form->field($model, 'user_id')->textInput() ?>
                    <?= $form->field($model, 'type')->textInput() ?>
                    <?= $form->field($model, 'domain')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'logo')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'name_short')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'text')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'website')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="box box-default">
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-group" id="cat-group">

                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <?= Html::dropDownList(null, null, ProductCategoryHelper::level(), ['id'=>'cat_id', 'prompt' => Yii::t('app', 'Выберите...'), 'class' => 'form-control']); ?>
                        </div>
                        <div class="col-md-3">
                            <?= DepDrop::widget([
                                'name' => 'cat_id1',
                                'options' => ['id' => 'cat_id1'],
                                'pluginOptions'=>[
                                    'depends'=>['cat_id'],
                                    'placeholder' => Yii::t('app', 'Выберите...'),
                                    'url' => Url::to(['/main/ajax/category'])
                                ]
                            ]); ?>
                        </div>
                        <div class="col-md-4">
                            <?= DepDrop::widget([
                                'name' => 'cat_id2',
                                'options' => ['id' => 'cat_id2'],
                                'pluginOptions'=>[
                                    'depends'=>['cat_id1'],
                                    'placeholder' => Yii::t('app', 'Выберите...'),
                                    'url' => Url::to(['/main/ajax/category'])
                                ]
                            ]); ?>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-primary btn-block" id="addcat">Добавить</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item ', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $contacts[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'address',
                    'email',
                    'phone1',
                    'phone2',
                    'coordinate',
                ],
            ]); ?>
            <div class="container-items">
                <?php foreach ($contacts as $i => $item) : ?>
                    <div class="item box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?= Yii::t('app', 'Филиал') ?></h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool remove-item"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <?php
                            if (!$item->isNewRecord) {
                                echo Html::activeHiddenInput($item, '[' . $i . ']id');
                            }
                            ?>
                            <?= $form->field($item, '[' . $i . ']address')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($item, '[' . $i . ']email')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($item, '[' . $i . ']phone1')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($item, '[' . $i . ']phone2')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($item, '[' . $i . ']coordinate')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <button type="button" class="btn btn-primary add-item"><?= Yii::t('app', 'Добавить филиал') ?></button>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Создать') : Yii::t('app', 'Сохранить'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
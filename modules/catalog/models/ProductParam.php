<?php

namespace app\modules\catalog\models;

use Yii;

/**
 * This is the model class for table "product_param".
 *
 * @property integer $id
 * @property integer $product_id
 * @property string $name
 * @property string $value
 *
 * @property Product $product
 */
class ProductParam extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_param';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            /*[['value'], 'required', 'when' => function($model){
                return $model->name != '';
            }, 'whenClient' => "function (attribute, value) {
                return $('#'+attribute.id.replace('value','name')).val() != '';
            }"],
            [['name'], 'required', 'when' => function($model){
                return $model->value != '';
            }, 'whenClient' => "function (attribute, value) {
                return $('#'+attribute.id.replace('name','value')).val() != '';
            }"],*/
            [['name', 'value'], 'required'],
            [['product_id'], 'integer'],
            [['name', 'value'], 'string', 'max' => 255],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'name' => Yii::t('app', 'Name'),
            'value' => Yii::t('app', 'Value'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}

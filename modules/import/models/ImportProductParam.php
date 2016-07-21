<?php

namespace app\modules\import\models;

use Yii;

/**
 * This is the model class for table "import_product_param".
 *
 * @property integer $id
 * @property integer $product_id
 * @property string $name
 * @property string $value
 *
 * @property ImportProduct $product
 */
class ImportProductParam extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'import_product_param';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'name', 'value'], 'required'],
            [['product_id'], 'integer'],
            [['name', 'value'], 'string', 'max' => 255],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => ImportProduct::className(), 'targetAttribute' => ['product_id' => 'id']],
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
        return $this->hasOne(ImportProduct::className(), ['id' => 'product_id']);
    }
}

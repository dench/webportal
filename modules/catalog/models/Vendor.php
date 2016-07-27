<?php

namespace app\modules\catalog\models;

use Yii;

/**
 * This is the model class for table "vendor".
 *
 * @property integer $id
 * @property string $name
 * @property boolean $enabled
 *
 * @property Product[] $products
 * @property ImportVendor[] $import
 */
class Vendor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vendor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['enabled'], 'boolean'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => Yii::t('app', 'Название'),
            'enabled' => Yii::t('app', 'Активно'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['vendor_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImportVendors()
    {
        return $this->hasMany(ImportVendor::className(), ['vendor_id' => 'id']);
    }
}

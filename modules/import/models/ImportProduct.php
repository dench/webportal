<?php

namespace app\modules\import\models;

use Yii;

/**
 * This is the model class for table "import_product".
 *
 * @property integer $id
 * @property integer $import_id
 * @property integer $remote_id
 * @property integer $category_id
 * @property string $code
 * @property string $vendor
 * @property string $name
 * @property string $description
 * @property integer $price
 * @property integer $oldprice
 * @property string $url
 * @property string $image
 * @property string $stock
 * @property string $guarantee
 * @property integer $status
 *
 * @property ImportCategory $category
 * @property Import $import
 * @property ImportProductParam[] $importProductParams
 * @property Product[] $products
 */
class ImportProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'import_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['import_id', 'remote_id', 'category_id', 'name', 'price'], 'required'],
            [['import_id', 'remote_id', 'category_id', 'price', 'oldprice', 'status'], 'integer'],
            [['description'], 'string'],
            [['code', 'vendor', 'name', 'url', 'image', 'stock', 'guarantee'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ImportCategory::className(), 'targetAttribute' => ['category_id' => 'category_id']],
            [['import_id'], 'exist', 'skipOnError' => true, 'targetClass' => Import::className(), 'targetAttribute' => ['import_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'import_id' => Yii::t('app', 'Import ID'),
            'remote_id' => Yii::t('app', 'Remote ID'),
            'category_id' => Yii::t('app', 'Category ID'),
            'code' => Yii::t('app', 'Code'),
            'vendor' => Yii::t('app', 'Vendor'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'price' => Yii::t('app', 'Price'),
            'oldprice' => Yii::t('app', 'Oldprice'),
            'url' => Yii::t('app', 'Url'),
            'image' => Yii::t('app', 'Image'),
            'stock' => Yii::t('app', 'Stock'),
            'guarantee' => Yii::t('app', 'Guarantee'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(ImportCategory::className(), ['category_id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImport()
    {
        return $this->hasOne(Import::className(), ['id' => 'import_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImportProductParams()
    {
        return $this->hasMany(ImportProductParam::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['import_id' => 'id']);
    }
}

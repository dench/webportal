<?php

namespace app\modules\catalog\models;

use app\behaviors\CreatorBehavior;
use app\modules\admin\modules\import\models\ImportProduct;
use app\modules\user\models\User;
use Yii;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property integer $import_id
 * @property integer $user_id
 * @property integer $category_id
 * @property string $code
 * @property integer $vendor_id
 * @property string $name
 * @property string $description
 * @property integer $price
 * @property integer $oldprice
 * @property integer $stock
 * @property integer $guarantee
 * @property integer $enabled
 *
 * @property ProductCategory $category
 * @property ImportProduct $import
 * @property User $user
 * @property Vendor $vendor
 * @property ProductParam[] $productParams
 */
class Product extends \yii\db\ActiveRecord
{
    const STOCK_NOT = 0;
    const STOCK_IN = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            CreatorBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'vendor_id', 'price', 'oldprice', 'stock'], 'integer'],
            [['category_id', 'vendor_id', 'name', 'price'], 'required'],
            [['description', 'guarantee'], 'string'],
            [['code', 'name'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
            /*[['import_id'], 'exist', 'skipOnError' => true, 'targetClass' => ImportProduct::className(), 'targetAttribute' => ['import_id' => 'id']],*/
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['vendor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vendor::className(), 'targetAttribute' => ['vendor_id' => 'id']],
            ['stock', 'default', 'value' => self::STOCK_IN],
            ['stock', 'in', 'range' => [self::STOCK_IN, self::STOCK_NOT]],
            [['enabled'], 'default', 'value' => 1],
            [['enabled'], 'boolean'],
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
            'user_id' => Yii::t('app', 'User ID'),
            'category_id' => Yii::t('app', 'Category ID'),
            'code' => Yii::t('app', 'Code'),
            'vendor_id' => Yii::t('app', 'Vendor ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'price' => Yii::t('app', 'Price'),
            'oldprice' => Yii::t('app', 'Oldprice'),
            'stock' => Yii::t('app', 'Stock'),
            'guarantee' => Yii::t('app', 'Guarantee'),
            'enabled' => Yii::t('app', 'Enabled'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(ProductCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImport()
    {
        return $this->hasOne(ImportProduct::className(), ['id' => 'import_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVendor()
    {
        return $this->hasOne(Vendor::className(), ['id' => 'vendor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductParams()
    {
        return $this->hasMany(ProductParam::className(), ['product_id' => 'id']);
    }
}

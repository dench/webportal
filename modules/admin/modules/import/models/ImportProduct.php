<?php

namespace app\modules\admin\modules\import\models;

use app\behaviors\CreatorBehavior;
use app\modules\catalog\models\Product;
use app\modules\catalog\models\Stock;
use app\modules\user\models\User;
use Yii;

/**
 * This is the model class for table "import_product".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $product_id
 * @property integer $remote_id
 * @property integer $category_id
 * @property integer $vendor_id
 * @property string $code
 * @property string $name
 * @property string $description
 * @property integer $price
 * @property integer $oldprice
 * @property string $url
 * @property string $image
 * @property integer $stock_id
 * @property string $guarantee
 * @property boolean $enabled
 *
 * @property User $user
 * @property Stock $stock
 * @property ImportVendor $vendor
 * @property ImportCategory $category
 * @property ImportProductParam[] $params
 * @property Product $product
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
            [['remote_id', 'category_id', 'vendor_id', 'name', 'price', 'stock_id'], 'required'],
            [['product_id', 'remote_id', 'category_id', 'vendor_id', 'price', 'oldprice', 'stock_id'], 'integer'],
            [['description'], 'string'],
            [['code', 'name', 'url', 'image', 'guarantee'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ImportCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['vendor_id'], 'exist', 'skipOnError' => true, 'targetClass' => ImportVendor::className(), 'targetAttribute' => ['vendor_id' => 'id']],
            [['enabled'], 'boolean'],
            // TODO: can't be null. why not?
            [['enabled'], 'default', 'value' => true],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Пользователь',
            'product_id' => 'Product ID',
            'remote_id' => 'Remote ID',
            'category_id' => Yii::t('app', 'Категория'),
            'code' => Yii::t('app', 'Код товара'),
            'vendor_id' => Yii::t('app', 'Производитель'),
            'name' => Yii::t('app', 'Название'),
            'description' => Yii::t('app', 'Описание'),
            'price' => Yii::t('app', 'Цена'),
            'oldprice' => Yii::t('app', 'Старая цена'),
            'url' => 'Url',
            'image' => Yii::t('app', 'Изображение'),
            'stock_id' => Yii::t('app', 'Наличие'),
            'guarantee' => Yii::t('app', 'Гарантия'),
            'enabled' => Yii::t('app', 'Активно'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(ImportCategory::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParams()
    {
        return $this->hasMany(ImportProductParam::className(), ['product_id' => 'id']);
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
        return $this->hasOne(ImportVendor::className(), ['id' => 'vendor_id']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @return Stock
     */
    public function getStock()
    {
        return Stock::findOne($this->stock_id);
    }
}

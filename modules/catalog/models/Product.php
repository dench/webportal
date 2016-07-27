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
 * @property integer $user_id
 * @property integer $category_id
 * @property string $code
 * @property integer $vendor_id
 * @property string $name
 * @property string $description
 * @property integer $price
 * @property integer $oldprice
 * @property integer $stock_id
 * @property integer $guarantee
 * @property boolean $enabled
 *
 * @property ProductCategory $category
 * @property ImportProduct $import
 * @property User $user
 * @property Stock $stock
 * @property Vendor $vendor
 * @property ProductParam[] $params
 */
class Product extends \yii\db\ActiveRecord
{
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
            [['category_id', 'vendor_id', 'price', 'oldprice', 'stock_id'], 'integer'],
            [['category_id', 'vendor_id', 'name', 'price', 'stock_id'], 'required'],
            [['description', 'guarantee'], 'string'],
            [['code', 'name'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['vendor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vendor::className(), 'targetAttribute' => ['vendor_id' => 'id']],
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
            'user_id' => Yii::t('app', 'Пользователь'),
            'category_id' => Yii::t('app', 'Категория'),
            'code' => Yii::t('app', 'Код товара'),
            'vendor_id' => Yii::t('app', 'Производитель'),
            'name' => Yii::t('app', 'Название'),
            'description' => Yii::t('app', 'Описание'),
            'price' => Yii::t('app', 'Цена'),
            'oldprice' => Yii::t('app', 'Старая цена'),
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
        return $this->hasOne(ProductCategory::className(), ['id' => 'category_id']);
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
    public function getParams()
    {
        return $this->hasMany(ProductParam::className(), ['product_id' => 'id']);
    }

    /**
     * @return Stock
     */
    public function getStock()
    {
        return Stock::findOne($this->stock_id);
    }
}

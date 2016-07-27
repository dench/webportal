<?php

namespace app\modules\catalog\models;

use app\behaviors\PositionBehavior;
use app\behaviors\TitleBehavior;
use app\modules\admin\modules\import\models\ImportCategory;
use Yii;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "product_category".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $slug
 * @property string $name
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property string $text
 * @property integer $position
 * @property boolean $enabled
 *
 * @property Product[] $products
 * @property ProductCategory $parent
 * @property ProductCategory[] $children
 * @property ImportCategory[] $import
 */
class ProductCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_category';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            PositionBehavior::className(),
            TitleBehavior::className(),
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'name',
                'ensureUnique' => true
            ],
        ];
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'position'], 'integer'],
            [['name'], 'required'],
            [['text'], 'string'],
            [['slug'], 'string', 'max' => 100],
            [['slug'], 'unique'],
            [['name', 'title', 'description', 'keywords'], 'string', 'max' => 255],
            [['name', 'title', 'slug', 'description', 'keywords', 'text'], 'trim'],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => self::className(), 'targetAttribute' => ['parent_id' => 'id']],
            [['enabled'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => Yii::t('app', 'Родительская категория'),
            'slug' => Yii::t('app', 'ЧПУ'),
            'name' => Yii::t('app', 'Название'),
            'title' => Yii::t('app', 'Заголовок'),
            'description' => Yii::t('app', 'Описание'),
            'keywords' => Yii::t('app', 'Ключевые слова'),
            'text' => Yii::t('app', 'Текст'),
            'enabled' => Yii::t('app', 'Включено'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(ProductCategory::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChildren()
    {
        return $this->hasMany(ProductCategory::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImport()
    {
        return $this->hasMany(ImportCategory::className(), ['category_id' => 'id']);

    }

}

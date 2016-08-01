<?php

namespace app\modules\admin\modules\import\models;

use app\behaviors\CreatorBehavior;
use app\modules\catalog\models\ProductCategory;
use app\modules\catalog\models\Stock;
use app\modules\user\models\User;
use Yii;

/**
 * This is the model class for table "import_category".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $remote_id
 * @property integer $parent_id
 * @property string $name
 * @property integer $category_id
 * @property boolean $enabled
 *
 * @property User $user
 * @property ProductCategory[] $category
 * @property ImportProduct[] $products
 */
class ImportCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'import_category';
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
            [['remote_id', 'name'], 'required'],
            [['remote_id', 'parent_id', 'category_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => self::className(), 'targetAttribute' => ['parent_id' => 'remote_id']],
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
            'user_id' => Yii::t('app', 'Пользователь'),
            'remote_id' => 'Remote ID',
            'parent_id' => 'Parent ID',
            'name' => Yii::t('app', 'Название'),
            'category_id' => Yii::t('app', 'Категория'),
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
    public function getProducts()
    {
        return $this->hasMany(ImportProduct::className(), ['category_id' => 'id']);
    }
}

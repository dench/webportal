<?php

namespace app\modules\company\models;

use app\modules\catalog\models\ProductCategory;
use app\modules\user\models\User;
use voskobovich\manytomany\ManyToManyBehavior;
use Yii;
use yii\helpers\StringHelper;

/**
 * This is the model class for table "company".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $type
 * @property string $domain
 * @property string $logo
 * @property string $name
 * @property string $name_short
 * @property string $description
 * @property string $text
 * @property string $website
 *
 * @property User $user
 * @property CompanyCategory[] $categories
 * @property CompanyContact[] $contacts
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company';
    }

    public function behaviors()
    {
        return [
            [
                'class' => ManyToManyBehavior::className(),
                'relations' => [
                    'category_ids' => 'categories',
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'name', 'type'], 'required'],
            ['name_short', 'required', 'when' => function ($model) {
                return StringHelper::byteLength($model->name) > 16;
            }, 'whenClient' => "function (attribute, value) {
                return $('#company-name').val().length > 16;
            }"],
            [['user_id', 'type'], 'integer'],
            [['type'], 'default', 'value' => 0],
            [['domain', 'logo', 'name', 'name_short', 'description', 'text', 'website'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['category_ids'], 'each', 'rule' => ['integer']]
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
            'type' => Yii::t('app', 'Пакет'),
            'domain' => Yii::t('app', 'Субдомен'),
            'logo' => Yii::t('app', 'Лого'),
            'name' => Yii::t('app', 'Название'),
            'name_short' => Yii::t('app', 'Короткое название'),
            'description' => Yii::t('app', 'Описание'),
            'text' => Yii::t('app', 'Текст'),
            'website' => Yii::t('app', 'Веб сайт'),
        ];
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
    public function getCategories()
    {
        return $this->hasMany(CompanyCategory::className(), ['company_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    /*public function getCategories()
    {
        return $this->hasMany(ProductCategory::className(), ['id' => 'category_id'])->viaTable('company_category', ['company_id' => 'id']);
    }*/

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContacts()
    {
        return $this->hasMany(CompanyContact::className(), ['company_id' => 'id']);
    }
}

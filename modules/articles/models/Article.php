<?php

namespace app\modules\articles\models;

use app\behaviors\CreatorBehavior;
use app\behaviors\PositionBehavior;
use app\behaviors\TitleBehavior;
use app\modules\user\models\User;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $category_id
 * @property string $slug
 * @property string $name
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property string $text
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $position
 * @property integer $view
 * @property boolean $enabled
 *
 * @property ArticleCategory $category
 * @property User $user
 * @property string $date
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            CreatorBehavior::className(),
            TitleBehavior::className(),
            PositionBehavior::className(),
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
            [['category_id', 'name'], 'required'],
            [['category_id', 'position', 'view'], 'integer'],
            [['text'], 'string'],
            [['slug'], 'string', 'max' => 100],
            [['name', 'title', 'description', 'keywords'], 'string', 'max' => 255],
            [['slug'], 'unique'],
            [['name', 'title', 'slug', 'description', 'keywords', 'text'], 'trim'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ArticleCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
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
            'user_id' => Yii::t('app', 'Автор'),
            'category_id' => Yii::t('app', 'Категория'),
            'slug' => Yii::t('app', 'ЧПУ'),
            'name' => Yii::t('app', 'Название'),
            'title' => Yii::t('app', 'Заголовок'),
            'description' => Yii::t('app', 'Описание'),
            'keywords' => Yii::t('app', 'Ключевые слова'),
            'text' => Yii::t('app', 'Текст'),
            'created_at' => Yii::t('app', 'Создано'),
            'updated_at' => Yii::t('app', 'Изменено'),
            'view' => Yii::t('app', 'Просмотров'),
            'enabled' => Yii::t('app', 'Включено'),
        ];
    }

    /**
     * @return string date formatter
     */
    public function getDate()
    {
        return Yii::$app->formatter->asDate($this->created_at);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(ArticleCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}

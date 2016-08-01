<?php

namespace app\modules\admin\modules\import\models;

use app\behaviors\CreatorBehavior;
use app\modules\user\models\User;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "import".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $format_id
 * @property integer $date
 * @property integer $created_at
 * @property string $rate
 * @property string $filename
 * @property boolean $enabled
 *
 * @property User $user
 * @property ImportFormat $format
 */
class Import extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'import';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'updatedAtAttribute' => false
            ],
            CreatorBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['format_id', 'filename'], 'required'],
            [['format_id', 'date'], 'integer'],
            [['rate'], 'number'],
            [['filename'], 'string', 'max' => 255],
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
            'user_id' => Yii::t('app', 'Пользователь'),
            'format_id' => Yii::t('app', 'Формат'),
            'date' => Yii::t('app', 'Дата создания'),
            'created_at' => Yii::t('app', 'Время загрузки'),
            'rate' => Yii::t('app', 'Rate'),
            'filename' => Yii::t('app', 'Имя файла'),
            'enabled' => Yii::t('app', 'Активно'),
        ];
    }

    /**
     * @return ImportFormat
     */
    public function getFormat()
    {
        return ImportFormat::findOne($this->format_id);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     */
    public function afterDelete()
    {
        ImportUpload::delete($this->filename);

        parent::afterDelete();
    }
}

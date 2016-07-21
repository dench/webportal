<?php

namespace app\modules\import\models;

use app\modules\user\models\User;
use Yii;

/**
 * This is the model class for table "import".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $format_id
 * @property integer $time
 * @property integer $created
 * @property string $rate
 * @property integer $status
 *
 * @property User $user
 * @property ImportCategory[] $importCategories
 * @property ImportProduct[] $importProducts
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
    public function rules()
    {
        return [
            [['user_id', 'format_id', 'time', 'created'], 'required'],
            [['user_id', 'format_id', 'time', 'created', 'status'], 'integer'],
            [['rate'], 'number'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'format_id' => Yii::t('app', 'Format ID'),
            'time' => Yii::t('app', 'Time'),
            'created' => Yii::t('app', 'Created'),
            'rate' => Yii::t('app', 'Rate'),
            'status' => Yii::t('app', 'Status'),
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
    public function getImportCategories()
    {
        return $this->hasMany(ImportCategory::className(), ['import_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImportProducts()
    {
        return $this->hasMany(ImportProduct::className(), ['import_id' => 'id']);
    }
}

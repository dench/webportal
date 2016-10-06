<?php

namespace app\modules\company\models;

use Yii;

/**
 * This is the model class for table "company_contact".
 *
 * @property integer $id
 * @property integer $company_id
 * @property string $address
 * @property string $email
 * @property string $phone1
 * @property string $phone2
 * @property string $coordinate
 *
 * @property Company $company
 */
class CompanyContact extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company_contact';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id', 'phone1'], 'required'],
            [['company_id'], 'integer'],
            [['address', 'email', 'phone1', 'phone2', 'coordinate'], 'string', 'max' => 255],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['company_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => Yii::t('app', 'Компания'),
            'address' => Yii::t('app', 'Адрес'),
            'email' => Yii::t('app', 'E-mail'),
            'phone1' => Yii::t('app', 'Телефон'),
            'phone2' => Yii::t('app', 'Телефон'),
            'coordinate' => Yii::t('app', 'Координаты'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }
}

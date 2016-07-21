<?php

namespace app\modules\import\models;

use Yii;

/**
 * This is the model class for table "import_category".
 *
 * @property integer $id
 * @property integer $import_id
 * @property integer $category_id
 * @property integer $parent_id
 * @property string $name
 *
 * @property Import $import
 * @property ImportProduct[] $importProducts
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
    public function rules()
    {
        return [
            [['import_id', 'category_id', 'name'], 'required'],
            [['import_id', 'category_id', 'parent_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['import_id'], 'exist', 'skipOnError' => true, 'targetClass' => Import::className(), 'targetAttribute' => ['import_id' => 'id']],
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
            'category_id' => Yii::t('app', 'Category ID'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImport()
    {
        return $this->hasOne(Import::className(), ['id' => 'import_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImportProducts()
    {
        return $this->hasMany(ImportProduct::className(), ['category_id' => 'category_id']);
    }
}

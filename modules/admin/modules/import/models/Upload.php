<?php
/**
 * Created by PhpStorm.
 * User: dench
 * Date: 22.07.16
 * Time: 13:56
 */

namespace app\modules\admin\modules\import\models;

use Yii;
use yii\base\Model;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class Upload extends Model
{
    /**
     * @var UploadedFile
     */
    public $xmlFile;

    /**
     * @var string
     */
    public $filename;

    public function rules()
    {
        return [
            [['xmlFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'xml'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'xmlFile' => Yii::t('app', 'Загрузка файла'),
        ];
    }

    /**
     * @return bool
     */
    public function upload()
    {
        if ($this->validate()) {
            $this->filename = md5(rand(1,999999)) . '.' . $this->xmlFile->extension;
            $this->xmlFile->saveAs(Yii::$app->params['uploads']['import_xml'] . '/' . $this->filename);
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $filename
     * @return bool
     */
    public static function delete($filename)
    {
        $path = Yii::$app->params['uploads']['import_xml'] . '/' . $filename;

        if (file_exists($path)) {
            return unlink($path);
        } else {
            return false;
        }
    }

    /**
     * @param $filename
     * @return string
     * @throws NotFoundHttpException
     */
    public static function read($filename)
    {
        $path = Yii::$app->params['uploads']['import_xml'] . '/' . $filename;

        if (file_exists($path)) {
            return file_get_contents($path);
        } else {
            throw new NotFoundHttpException('The requested file does not exist.');
        }
    }
}
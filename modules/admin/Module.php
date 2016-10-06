<?php

namespace app\modules\admin;
use Yii;

/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\admin\controllers';

    public $layout = 'main';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        Yii::$app->assetManager->bundles['yii\bootstrap\BootstrapAsset'] = [
            'basePath'   => '@web',
            'sourcePath' => null,
            'css'        => ['css/bootstrap_admin.css']
        ];

        // custom initialization code goes here
    }
}

<?php

$params = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'version' => '0.1',
    'name' => 'Web Portal',
    'basePath' => dirname(__DIR__),
    'language' => 'ru_RU',
    'sourceLanguage' => 'ru_RU',
    'bootstrap' => ['log'],
    'modules' => [
        'main' => [
            'class' => 'app\modules\main\Module',
        ],
        'user' => [
            'class' => 'app\modules\user\Module',
        ],
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],
        'page' => [
            'class' => 'app\modules\page\Module',
        ],
        'article' => [
            'class' => 'app\modules\article\Module',
        ],
    ],
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
        ],
        'cache' => [
            'class' => 'yii\caching\DummyCache',
        ],
        'log' => [
            'class' => 'yii\log\Dispatcher',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'pattern' => '<slug:\w+>',
                    'route' => 'page/default/index',
                    'suffix' => '.html',
                ],
                '<module:(admin)>' => '<module>/default/index',
                '<module:(admin)>/<controller>' => '<module>/<controller>/index',
            ],
        ],
    ],
    'params' => $params,
];
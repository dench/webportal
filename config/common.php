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
        'articles' => [
            'class' => 'app\modules\articles\Module',
        ],
        'catalog' => [
            'class' => 'app\modules\catalog\Module',
        ],
        'import' => [
            'class' => 'app\modules\import\Module',
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
            'suffix' => '/',
            'rules' => [
                [
                    'pattern' => '<slug:[\w_-]+>',
                    'route' => 'page/default/index',
                    'suffix' => '.html',
                ],
                [
                    'pattern' => 'article/<slug:[\w_-]+>',
                    'route' => 'articles/default/view',
                    'suffix' => '.html',
                ],
                '<module:articles>/<slug:[\w_-]+>' => '<module>/default/index',
                '<module:(admin|articles)>' => '<module>/default/index',
                '<module:admin>/<controller>' => '<module>/<controller>/index',
            ],
        ],
    ],
    'params' => $params,
];
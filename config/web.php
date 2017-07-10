<?php
$config = [
    'id' => 'news',
    'basePath' => __DIR__ . '/../',
    'controllerNamespace' => 'app\controllers',
    'viewPath' => __DIR__ . '/../views',
    'defaultRoute' => 'main/index',
    'bootstrap' => ['debug'],
    'modules' => [
        'debug' => [
            'class' => 'yii\debug\Module',
        ],
    ],

    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'request' => [
            'enableCookieValidation' => false,
            'enableCsrfValidation' => false,
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'enableSession' => true,
            'loginUrl' => ['authentication/login'],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [

                    'sourcePath' => null,
                    'js' => [
                        '//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js',
                    ],
                ]
            ],
        ],

    ],
];
<?php

use yii\rbac\DbManager;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'UUe4gB3PFfnXMrVCMYj3yuskxf_G-6MQ',
            'parsers' => [
                'multipart/form-data' => 'yii\web\MultipartFormDataParser',
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'authManager' => [
            'class' => DbManager::class,
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                ['class' => \yii\rest\UrlRule::class, 'controller' => 'api/telemetry']
            ],
        ],
    ],
    'params' => $params,

    'modules' => [
        'api' => [
            'class' => app\modules\api\Module::class,
        ],
        'telemetry' => [
            'class' => app\modules\telemetry\Module::class,
        ],
        'users' => [
            'class' => app\modules\users\Module::class,
        ],
        'webSocket' => [
            'class' => app\modules\webSocket\Module::class,
        ],
        'admin' => [
            'class' => app\modules\admin\Module::class,
        ],
    ]
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
//    $config['modules']['telemetry'] = [
//        'class' => 'app\modules\telemetry\Module',
//    ];
//    $config['modules']['users'] = [
//        'class' => 'app\modules\users\Module',
//    ];
//    $config['modules']['webSocket'] = [
//        'class' => 'app\modules\webSocket\Module',
//    ];
//    $config['modules']['api'] = [
//        'class' => app\modules\api\Module::class,
//    ];
}

return $config;

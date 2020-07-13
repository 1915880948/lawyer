<?php

use yii\helpers\ArrayHelper;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$db2 = require __DIR__ . '/db2.php';

if(file_exists(__DIR__ . "/db-local.php")){
    $db = require __DIR__ . '/db-local.php';
}

$config = [
    'id'         => 'basic',
    'basePath'   => dirname(__DIR__),
    'bootstrap'  => ['log'],
    'aliases'    => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@key'   => __DIR__ . '/apiclient_key.pem',
        '@cert'  => __DIR__ . '/apiclient_cert.pem',
    ],
    'components' => [
        'request'      => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'SvgIyDFt8P_plHfotort_Yy1ZhUeduW8',
            'parsers'             => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'session' => [
            'class' => 'yii\web\Session',
            'cookieParams' => [
                'domain' => 'www.huayu.com', // 这里固定你的session域名
                'lifetime' => 10,
            ],
            'name' => 'PHPSESSID_FOR_HUAYU', // 最好是不同的域名也设置不同的name
        ],
        'cache'        => [
            'class' => 'yii\caching\FileCache',
        ],
        'user'         => [
            'identityClass'   => 'app\models\IUser',
            'enableAutoLogin' => true,
        ],
        'view'         => [
            'class'            => 'app\common\blade\BladeView',
            'defaultExtension' => 'blade.php',
            'renderers'        => [
                'blade' => [
                    'class'     => 'app\common\blade\ViewRenderer',
                    'cachePath' => '@runtime/cache',
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'log'          => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'  => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db'           => $db,
        'db2'           => $db2,
        'urlManager'   => [
            'enablePrettyUrl' => true,
            'showScriptName'  => false,
            'rules'           => [


            ],
        ]
    ],
    'modules'    => [
        'cms' => [
            'class'        => 'app\modules\cms\Module',
            //默认默认路由为site
            'defaultRoute' => 'site',
            'layout'=>'main'
        ],
        'en' => [
            'class'        => 'app\modules\en\Module',
            //默认默认路由为site
            'defaultRoute' => 'site',
            'layout'=>'main'
        ],
        'encms' => [
            'class'        => 'app\modules\encms\Module',
            //默认默认路由为site
            'defaultRoute' => 'site',
            'layout'=>'main'
        ],
    ],
    'params'     => $params,
];

if(YII_ENV_DEV){
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}
if(file_exists(__DIR__ . "/web-local.php")){
    $config = ArrayHelper::getValue($config, (array) require __DIR__ . "/web-local.php");
}
return $config;

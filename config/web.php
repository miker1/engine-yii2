<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'layout'=>'main',
    'defaultRoute'=>'main/index',
    'language'=>'ru_RU',
    'charset'=>'UTF-8',
    /*
     * add modules
     * мой блог, подключение модуля
     */
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],
        'blog' => [
            'class' => 'app\modules\blog\Module',
        ],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'my_rules',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'loginUrl'=>['main/index']//переопределяем действие входа
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        
        /*
         * This connection is necessary add after install this application
         */
        'urlManager'=>[
            'class'=>'yii\web\UrlManager',
            //Disable index.php
            'showScriptName'=>false,
            //Disable r= routes
            'enablePrettyUrl'=>true,
            /*если маршрут не найден, сразу выдает 404 без перехода по маршруту(что-то глючит)
             *'enableStrictParsing'=>true,
             *в правилах необходимо указать все возможные маршруты (если true) 
            */
            'rules'=>[
                [
                  'pattern'=>'',
                  'route'=>'main/index',
                  'suffix'=>''
                ],
                [
                  'pattern'=>'search-<search:\w*>-<year:\d{4}>',
                  'route'=>'main/search',
                  'suffix'=>'.php'
                ],
                [
                  'pattern'=>'search-<search:\w*>',
                  'route'=>'main/search',
                  'suffix'=>'.php'
                ],
                [
                  'pattern'=>'<controller>/<action>/<id:\d+>',
                  'route'=>'<controller>/<action>',
                  'suffix'=>''
                ],
                [
                  'pattern'=>'<controller>/<action>',
                  'route'=>'<controller>/<action>',
                  'suffix'=>'.php'
                ],
                [
                  'pattern'=>'<module>/<controller>/<action>/<id:\d+>',
                  'route'=>'<module>/<controller>/<action>',
                  'suffix'=>'.php'
                ],
                [
                  'pattern'=>'<module>/<controller>/<action>',
                  'route'=>'<module>/<controller>/<action>',
                  'suffix'=>'.php'
                ],
            ]
            
            
            /*
             * рабочий код, обеспечивающий весь функционал приложения
            'rules'=>array(
                '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<module:[\wd-]+>/<controller:[\wd-]+>/<action:[\wd-]+>/<id:\d+>' => '<module>/<controller>/<action>',
            ),
             */
            
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
        'db' => require(__DIR__ . '/db.php'),
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;

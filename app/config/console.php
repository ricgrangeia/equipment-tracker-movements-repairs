<?php

$params = require __DIR__ . '/params.php';
$email = require __DIR__ . '/email.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@tests' => '@app/tests',
    ],
    //    'modules' => [
    //        'audit' => 'bedezign\yii2\audit\Audit',
    //    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        //        'errorHandler' => [
        //            // console error handler
        //            'class' => '\bedezign\yii2\audit\components\console\ErrorHandler',
        //        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'mailer' => $email,
        'db' => $db,
    ],
    'params' => $params,

    //    'controllerMap' => [
    //        'migrate' => [
    //            'migrationNamespaces' => [
    //                # Other migration namespaces
    //                'bedezign\yii2\audit\migrations',
    //            ],
    ////        'fixture' => [ // Fixture generation command line.
    ////            'class' => 'yii\faker\FixtureController',
    ////        ],
    //        ],
    //    ],

];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;

<?php

$params = require __DIR__ . '/params.php';
$email = require __DIR__ . '/email.php';
$db = require __DIR__ . '/db.php';

$config = [
    'name' => 'Equipamentos',
    'language' => 'pt-PT',
    'sourceLanguage' => 'pt-PT',
    'id' => 'basicGestaoEquipamentos',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'log',
        'admin',
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@adminlte' => '@vendor/almasaeed2010/adminlte/dist',
        '@mdm/admin/messages' => '@vendor/mdmsoft/yii2-admin/messages',
        '@mdm/admin/assets' => '@vendor/mdmsoft/yii2-admin/assets',
        '@mdm/admin' => '@vendor/mdmsoft/yii2-admin',
    ],
    'modules' => [
        /**********************************************
         * RBAC for Yii2 and for all Web Applications
         **********************************************/
        'admin' => [
            'class' => mdm\admin\Module::class,
            'layout' => '@app/themes/rbac/layouts/left-menu.php',
            'mainLayout' => '@app/themes/adminlte/layouts/main.php',
            'controllerMap' => [
                'assignment' => [
                    'class' => mdm\admin\controllers\AssignmentController::class,
                    'userClassName' => \mdm\admin\models\User::class,
                    'idField' => 'id',
                ],
            ],
        ],

        'Ajax' => ['class' => \app\modules\Ajax\ModuleAjax::class],
        'Empresa' => ['class' => \app\modules\Empresa\ModuleEmpresa::class],
        'Equipamento' => ['class' => \app\modules\Equipamento\ModuleEquipamento::class],
        'EquipamentoMovimento' => ['class' => \app\modules\EquipamentoMovimento\ModuleEquipamentoMovimento::class],
        'EquipamentoMovimentoTipo' => ['class' => \app\modules\EquipamentoMovimentoTipo\ModuleEquipamentoMovimentoTipo::class],
        'EquipamentoEstado' => ['class' => \app\modules\EquipamentoEstado\ModuleEquipamentoEstado::class],
        //        'audit' => 'bedezign\yii2\audit\Audit',
        'gridview' => [
            'class' => '\kartik\grid\Module',
            'bsVersion' => '4.x',
        ],
        'imagemanager' => [
            'class' => 'petersonsilvadejesus\imagemanager\Module',
            // set if login is required to access the module or not.
            'login' => false,
            //set accces rules ()
            'canUploadImage' => true,
            'canRemoveImage' => function () {

                return true;
            },
            'deleteOriginalAfterEdit' => false, // false: keep original image after edit. true: delete original image after edit
            // Set if blameable behavior is used, if it is, callable function can also be used
            'setBlameableBehavior' => false,
            //add css files (to use in media manage selector iframe)
            'cssFiles' => [
                'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css',
            ],
        ],
    ],
    //    'controllerMap' => [
    //        'migrate' => [
    //            'class' => 'yii\console\controllers\MigrateController',
    //            'migrationNamespaces' => [
    //                # Other migration namespaces
    //                'bedezign\yii2-audit\migrations',
    //            ],
    //        ],
    //    ],
    'components' => [
        'session' => [
            'class' => 'yii\web\Session',
        ],

        'view' => [
            /**********************************************
             * For Theme Configuration
             *********************************************/
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@app/themes/adminlte',
                    '@mdm/admin/views' => '@app/themes/rbac/views',
                    '@app/views/layouts' => '@app/themes/rbac/layouts',
                ],
            ],
        ],
        'assetManager' => [
            'bundles' => [
                'kartik\form\ActiveFormAsset' => [
                    'bsDependencyEnabled' => false, // do not load bootstrap assets for a specific asset bundle
                ],
            ],
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'en',
                    'basePath' => '@app/messages',
                    //'sourceLanguage' => 'en-US',
                    //                    'fileMap' => [
                    //                        'app' => 'app.php',
                    //                        'app/error' => 'error.php',
                    //                    ],
                ],
                'yii2-ajaxcrud' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                    'sourceLanguage' => 'en',
                ],
                'ajax' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/modules/Ajax/messages',
                    'sourceLanguage' => 'en',
                ],

                // 'modules/Armazem/armazem' => [
                // 	'class' => 'yii\i18n\PhpMessageSource',
                // 	'basePath' => '@app/modules/Armazem/messages',
                // 	'sourceLanguage' => 'pt-PT',
                // ],

            ],
        ],
        'imagemanager' => [
            'class' => 'petersonsilvadejesus\imagemanager\components\ImageManagerGetPath',
            //set media path (outside the web folder is possible)
            'mediaPath' => '../../images',
            //path relative web folder. In case of multiple environments (frontend, backend) add more paths
            'cachePath' => ['assets/images', '../../web/assets/images'],
            //use filename (seo friendly) for resized images else use a hash
            'useFilename' => true,
            //show full url (for example in case of a API)
            'absoluteUrl' => false,
            'databaseComponent' => 'db', // The used database component by the image manager, this defaults to the Yii::$app->db component
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'H6VT5rQ9Lc1U2c-KOM3QTVQWIH9kTTCp',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'mdm\admin\models\User',
            'loginUrl' => ['admin/user/login'],
            'authTimeout' => 900,
            'absoluteAuthTimeout' => 5400,
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['Convidado'],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
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
        'mailer' => $email,
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'site/index',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ],
        ],
    ],

    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            //            'debug/*',
            //            'site/*', // add or remove allowed actions to this list
            //            'admin/*', // add or remove allowed actions to this list
        ],
    ],

    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1'],
        'generators' => [ // here
            'crud' => [ // generator name
                'class' => 'yii\gii\generators\crud\Generator', // generator class
                'templates' => [ // setting for our templates
                    'yii2-adminlte3' => '@vendor/hail812/yii2-adminlte3/src/gii/generators/crud/default', // template name => path to template
                    'yii2-adminlte3-Bootsrap4' => '@vendor/hail812/yii2-adminlte3/src/gii/generators/crud/defaultBootstrap4', // template name => path to template
                ],
            ],
        ],
    ];
}

return $config;

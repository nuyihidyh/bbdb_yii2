<?php

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
            'cookieValidationKey' => 'dKSC8-fKRZFOSfUctedMXUMD2Zpk0Z5k',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'class' => 'app\modules\user\components\User',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            'messageConfig' => [
                'from' => ['nurul.hidayah@brainybunch.com' => 'Admin'], // this is needed for sending emails
                'charset' => 'UTF-8',
                ],
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'gmail-smtp-msa.l.google.com',
                'username' => 'nurul.hidayah@brainybunch.com',
                'password' => 'nuyihidayah',
                'port' => '587',
                'encryption' => 'tls',

                //comment on production
                'streamOptions' =>[
                    'ssl' => [
                        'verify_peer' =>false,
                        'verify_peer_name' => false,
                    ]
                ]
            ]
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

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],

        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'facebook' => [
                    'class' => 'yii\authclient\clients\Facebook',
                    'clientId' => '195568564341184',
                    'clientSecret' => '354836331a97860971bb7bc4d544e124',
                    'scope' => 'email',
                ],

            ],
        ],

    ],
    'params' => $params,
    'modules' => [
        'user' => [
            'class' => 'app\modules\user\Module',
        ],
        'registration' => [
            'class' => 'app\modules\registration\Module',
        ],
        'administrator' => [
            'class' => 'app\modules\administrator\Module',
        ],
        'fee' => [
            'class' => 'app\modules\fee\Module',
        ],
    ],

];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;

<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=cdpanko13013',
            'username' => 'cdpanko13013',
            'password' => 'e04d9aacfa',
            'charset' => 'utf8',
        ],
    ],
];

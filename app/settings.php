<?php

const APP_ROOT = __DIR__;

return [
    'settings' => [
        'displayErrorDetails' => true,
        'determineRouteBeforeAppMiddleware' => false,

        'doctrine' => [
            'dev_mode' => true,
            'cache_dir' => APP_ROOT . '/var/doctrine',
            'metadata_dirs' => [APP_ROOT . '/Entity'],
            'connection' => [
                'driver' => 'pdo_mysql',
                'host' => 'localhost',
                'port' => 3306,
                'dbname' => 'slim',
                'user' => 'slim',
                'password' => 'slim-test',
                'charset' => 'utf8'
            ],
            'meta' => [
                'entity_path' => [
                    'app/Entity'
                ],
                'auto_generate_proxies' => true,
                'proxy_dir' =>  __DIR__.'/../var/doctrine/cache/proxies',
                'cache' => null,
            ],
        ]
    ]
];
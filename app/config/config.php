<?php

defined('APP_PATH') || define('APP_PATH', realpath('.'));

return new \Phalcon\Config(array(
    'database' => array(
        'adapter'     => 'mysql',
        'host'        => 'localhost',
        'username'    => 'root',
        'password'    => '',
        'dbname'      => 't4l',
        'charset'     => 'utf8',
    ),
//    'database' => array(
//        'adapter'     => getenv('DB_ADAPTER'),
//        'host'        => getenv('DB_HOST'),
//        'username'    => getenv('DB_USERNAME'),
//        'password'    => getenv('DB_PASSWORD'),
//        'dbname'      => getenv('DB_DATABASE'),
//        'port'        => getenv('DB_PORT'),
//        'charset'     => getenv('DB_CHARSET'),
//    ),
    'application' => array(
        'controllersDir' => APP_PATH . '/app/controllers/',
        'modelsDir'      => APP_PATH . '/app/models/',
        'migrationsDir'  => APP_PATH . '/app/migrations/',
        'viewsDir'       => APP_PATH . '/app/views/',
        'pluginsDir'     => APP_PATH . '/app/plugins/',
        'librariesDir'   => APP_PATH . '/app/libraries/',
        'cacheDir'       => APP_PATH . '/app/cache/',
        'baseUri'        => 'http://api.local',
    )
));

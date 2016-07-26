<?php

defined('ROOT_PATH') || define('ROOT_PATH', realpath('.'));

return new \Phalcon\Config(array(
    'database' => array(
        'adapter'     => 'mysql',
        'host'        => 'localhost',
        'username'    => 'root',
        'password'    => '',
        'dbname'      => 'api',
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
        'controllersDir' => ROOT_PATH . '/app/controllers/',
        'modelsDir'      => ROOT_PATH . '/app/models/',
        'migrationsDir'  => ROOT_PATH . '/app/migrations/',
        'viewsDir'       => ROOT_PATH . '/app/views/',
        'pluginsDir'     => ROOT_PATH . '/app/plugins/',
        'librariesDir'   => ROOT_PATH . '/app/libraries/',
        'cacheDir'       => ROOT_PATH . '/app/cache/',
        'baseUri'        => 'http://phalcon.local',
    )
));

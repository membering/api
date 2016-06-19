<?php
/**
 * Created by PhpStorm.
 * User: HOME
 * Date: 6/18/2016
 * Time: 1:16 PM
 */

defined('APP_PATH') || define('APP_PATH', realpath('.'));

$application->registerModules(array(
    'frontend' => array(
        'className' => 'App\Frontend\Module',
        'path' => APP_PATH . '/app/modules/frontend/Module.php'
    ),
//    'auth' => array(
//        'className' => 'App\Auth\Module',
//        'path' => APP_PATH . '/app/modules/auth/Module.php'
//    )
));
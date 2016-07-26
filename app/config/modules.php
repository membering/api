<?php
/**
 * Created by PhpStorm.
 * User: HOME
 * Date: 6/18/2016
 * Time: 1:16 PM
 */

defined('ROOT_PATH') || define('ROOT_PATH', realpath('.'));

$application->registerModules(array(
    'frontend' => array(
        'className' => 'App\Frontend\Module',
        'path' => ROOT_PATH . '/app/modules/frontend/Module.php'
    ),
    'auth' => array(
        'className' => 'App\Auth\Module',
        'path' => ROOT_PATH . '/app/modules/auth/Module.php'
    )
));
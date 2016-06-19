<?php

defined('APP_PATH') || define('APP_PATH', realpath('.'));

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader
    ->registerDirs(
        array(
            $config->application->controllersDir,
            $config->application->modelsDir
        )
    )
    ->registerNamespaces(
        array(
            'Libraries' => APP_PATH . '/app/libraries',
            'Phalcon\OAuth2\Server' => APP_PATH . '/app/libraries/OAuth2'
        )
    )
    ->register();
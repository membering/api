<?php

defined('ROOT_PATH') || define('ROOT_PATH', realpath('.'));

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader
    ->registerDirs(
        array(
            $config->application->modelsDir
        )
    )
    ->registerNamespaces(
        array(
            'Libraries' => ROOT_PATH . '/app/libraries'
        )
    )
    ->register();
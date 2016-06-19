<?php

error_reporting(E_ALL);

define('APP_PATH', realpath('..'));

try {
    require APP_PATH . '/vendor/autoload.php';

    $dotenv = new Dotenv\Dotenv(APP_PATH);
    $dotenv->load();

    /**
     * Read the configuration
     */
    $config = include APP_PATH . '/app/config/config.php';

    /**
     * Read auto-loader
     */
    include APP_PATH . '/app/config/loader.php';

    /**
     * Read services
     */
    include APP_PATH . '/app/config/services.php';

    /**
     * Handle the request
     */
    $application = new \Phalcon\Mvc\Application($di);

    /**
     * Read modules
     */
    include APP_PATH . '/app/config/modules.php';

    /**
     * Read routers
     */
    include APP_PATH . '/app/config/routers.php';

    echo $application->handle()->getContent();

} catch (\Exception $e) {
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}

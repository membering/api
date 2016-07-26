<?php

error_reporting(E_ALL);

try {
    define('ROOT_PATH', realpath('..'));

    require ROOT_PATH . '/vendor/autoload.php';

    $dotenv = new Dotenv\Dotenv(ROOT_PATH);
    $dotenv->load();

    define('APP_ENV' , getenv('APP_ENV'));

    /**
     * Read the configuration
     */
    $config = include ROOT_PATH . '/app/config/config.php';

    /**
     * Read auto-loader
     */
    include ROOT_PATH . '/app/config/loader.php';

    /**
     * Read services
     */
    include ROOT_PATH . '/app/config/services.php';

    /**
     * Handle the request
     */
    $application = new \Phalcon\Mvc\Application($di);

    /**
     * Read modules
     */
    include ROOT_PATH . '/app/config/modules.php';

    /**
     * Read routers
     */
    include ROOT_PATH . '/app/config/routers.php';

    echo $application->handle()->getContent();

} catch (\Exception $e) {
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}

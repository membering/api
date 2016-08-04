<?php

use Libraries\HttpStatusCode;
use Phalcon\Http\Response;

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
    $response = new Response();

    $array['status'] = HttpStatusCode::SERVICE_UNAVAILABLE;
    $array['message'] = $e->getMessage();

    $response->setContentType('application/json', 'UTF-8');
    $response->setStatusCode(HttpStatusCode::SERVICE_UNAVAILABLE);
    $response->setJsonContent($array);
    $response->send();
}

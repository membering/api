<?php
/**
 * Services are globally registered in this file
 *
 * @var \Phalcon\Config $config
 */

use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Session\Adapter\Files as SessionAdapter;

defined('ROOT_PATH') || define('ROOT_PATH', realpath('.'));

/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 */
$di = new FactoryDefault();

$di->setShared('config', function () use ($config) {
    return $config;
});

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->setShared('url', function () use ($config) {
    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);

    return $url;
});

/**
 * Setting up the view component
 */
$di->setShared('view', function () use ($config) {
    $view = new View();
    $view->setViewsDir($config->application->viewsDir);
    return $view;
});

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->setShared('db', function () use ($config) {
    $dbConfig = $config->database->toArray();
    $adapter = $dbConfig['adapter'];
    unset($dbConfig['adapter']);

    $class = 'Phalcon\Db\Adapter\Pdo\\' . $adapter;

    return new $class($dbConfig);
});

/**
 * Start the session the first time some component request the session service
 */
$di->setShared('session', function () {
    $session = new SessionAdapter();
    $session->start();

    return $session;
});

$di->setShared('oauth', function () use ($config) {
    $dbConfig = $config->database->toArray();
    $dsn      = $dbConfig['adapter'].':dbname='.$dbConfig['dbname'].';host='.$dbConfig['host'];
    $username = $dbConfig['username'];
    $password = $dbConfig['password'];

    OAuth2\Autoloader::register();

    // $dsn is the Data Source Name for your database, for exmaple "mysql:dbname=my_oauth2_db;host=localhost"
    $storage = new OAuth2\Storage\Pdo(array('dsn' => $dsn, 'username' => $username, 'password' => $password));

    // Pass a storage object or array of storage objects to the OAuth2 server class
    $server = new OAuth2\Server($storage);

    // Add the "Client Credentials" grant type (it is the simplest of the grant types)
    $server->addGrantType(new OAuth2\GrantType\ClientCredentials($storage));

    // Add the "Authorization Code" grant type (this is where the oauth magic happens)
    $server->addGrantType(new OAuth2\GrantType\AuthorizationCode($storage));
    
    return $server;
});
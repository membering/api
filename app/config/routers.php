<?php
/**
 * Created by PhpStorm.
 * User: HOME
 * Date: 6/18/2016
 * Time: 1:06 PM
 */

defined('ROOT_PATH') || define('ROOT_PATH', realpath('.'));

use Phalcon\Mvc\Router;

$di->set('router', function () use ($application) {
    $router = new Router();
    $router->setDefaultModule('frontend');

    foreach ($application->getModules() as $key => $module) {
        $routeClass = str_replace('Module', 'Route', $module['className']);
        $routePath = str_replace('Module', 'Route', $module['path']);
        if (file_exists($routePath) && is_file($routePath)) {
            include $routePath;
            $classRouter = new $routeClass();
            if (method_exists($classRouter, 'get')) {
                $router = $classRouter->get($router);
            }
        }
    }

    $router->removeExtraSlashes(true);
    return $router;
});
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
        $namespace = str_replace('Module', 'Controllers', $module["className"]);
        $moduleRouter = ROOT_PATH . '/app/modules/' . $key . '/Router.php';
        if (file_exists($moduleRouter) && is_file($moduleRouter)) {
            $router = include $moduleRouter;
        }
        else {
            $router->add('/' . $key . '/:params', array(
                'namespace' => $namespace,
                'module' => $key,
                'controller' => 'index',
                'action' => 'index',
                'params' => 1
            ))->setName($key);
            $router->add('/' . $key . '/:controller/:params', array(
                'namespace' => $namespace,
                'module' => $key,
                'controller' => 1,
                'action' => 'index',
                'params' => 2
            ));
            $router->add('/' . $key . '/:controller/:action/:params', array(
                'namespace' => $namespace,
                'module' => $key,
                'controller' => 1,
                'action' => 2,
                'params' => 3
            ));
        }
    }

    return $router;
});
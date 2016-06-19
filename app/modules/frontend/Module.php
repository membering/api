<?php
/**
 * Created by PhpStorm.
 * User: HOME
 * Date: 6/18/2016
 * Time: 1:26 PM
 */

namespace App\Frontend;

use Phalcon\Loader;
use Phalcon\DiInterface;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\ModuleDefinitionInterface;

class Module implements ModuleDefinitionInterface
{
    const MODULE_NAMESPACE = 'App\Frontend\Controllers';
    /**
     * Register a specific autoloader for the module
     */
    public function registerAutoloaders(DiInterface $di = null)
    {
        $loader = new Loader();
        $loader->registerNamespaces(array(
            self::MODULE_NAMESPACE => __DIR__ . '/controllers/'
        ));
        $loader->register();
    }

    /**
     * Register specific services for the module
     */
    public function registerServices(DiInterface $di)
    {
        $di->set('dispatcher', function () {
            $dispatcher = new Dispatcher();
            $dispatcher->setDefaultNamespace(self::MODULE_NAMESPACE);
            return $dispatcher;
        });
    }
}
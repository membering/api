<?php
/**
 * Created by PhpStorm.
 * User: HOME
 * Date: 6/18/2016
 * Time: 1:26 PM
 */

namespace App\Auth;

use Phalcon\Loader;
use Phalcon\DiInterface;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\ModuleDefinitionInterface;

class Module implements ModuleDefinitionInterface
{
    const MODULE_NAMESPACE = 'App\Auth';
    /**
     * Register a specific autoloader for the module
     */
    public function registerAutoloaders(DiInterface $di = null)
    {
        $loader = new Loader();
        $loader->registerNamespaces(array(
            self::MODULE_NAMESPACE . '\Controllers' => __DIR__ . '/controllers/',
            self::MODULE_NAMESPACE. '\Validators' => __DIR__ . '/validators/'
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
            $dispatcher->setDefaultNamespace(self::MODULE_NAMESPACE . '\Controllers');
            return $dispatcher;
        });
    }
}
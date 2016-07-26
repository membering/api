<?php
/**
 * Created by PhpStorm.
 * User: HOME
 * Date: 6/18/2016
 * Time: 1:43 PM
 */

namespace App\Auth;

use Phalcon\Mvc\Router;
use Phalcon\Mvc\Router\Group;

$router = new Router();

$group = new Group(array(
    'module' => 'auth'
));

$group->setPrefix('/auth');

$group->add('/token', array(
    'controller' => 'index',
    'action' => 'token'
));

$group->add('/authorize', array(
    'controller' => 'index',
    'action' => 'authorize'
));

$group->add('/resource', array(
    'controller' => 'index',
    'action' => 'resource'
));

$group->add('/register', array(
    'controller' => 'user',
    'action' => 'register'
));

$group->add('/login', array(
    'controller' => 'user',
    'action' => 'login'
));

$group->add('/logout', array(
    'controller' => 'user',
    'action' => 'logout'
));

$router->mount($group);

return $router;
<?php
/**
 * Created by PhpStorm.
 * User: HOME
 * Date: 6/18/2016
 * Time: 1:43 PM
 */

namespace App\Frontend;

use Phalcon\Mvc\Router;
use Phalcon\Mvc\Router\Group;

$router = new Router();

$group = new Group(array(
    'module' => 'frontend'
));

$group->setPrefix('');

$group->add('/', array(
    'controller' => 'index',
    'action' => 'index'
));

//$group->add('/token', array(
//    'controller' => 'index',
//    'action' => 'token'
//));
//
//$group->add('/authorize', array(
//    'controller' => 'index',
//    'action' => 'authorize'
//));
//
//$group->add('/resource', array(
//    'controller' => 'index',
//    'action' => 'resource'
//));

//Add the group to the router
$router->mount($group);

return $router;
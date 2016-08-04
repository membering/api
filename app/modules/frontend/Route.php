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

class Route
{
    public function get(Router $router)
    {
        $group = new Group(array(
            'module' => 'frontend'
        ));
        $group->setPrefix('');

        $group->add('/', array(
            'controller' => 'index',
            'action' => 'index'
        ));

        $group->add('/test', array(
            'controller' => 'index',
            'action' => 'test'
        ));

        $router->mount($group);
        return $router;
    }
}
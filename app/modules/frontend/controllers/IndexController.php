<?php
/**
 * Created by PhpStorm.
 * User: HOME
 * Date: 6/18/2016
 * Time: 1:34 PM
 */

namespace App\Frontend\Controllers;

use Libraries\ControllerBase;
use OauthClients;

class IndexController extends ControllerBase
{
    public function indexAction()
    {
        $oauth_users = OauthClients::findFirst();
        $this->response($oauth_users);
    }

    public function testAction()
    {
        echo 'Module Frontend ' . getenv('DB_ADAPTER');
    }
}
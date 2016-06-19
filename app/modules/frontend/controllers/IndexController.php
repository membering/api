<?php
/**
 * Created by PhpStorm.
 * User: HOME
 * Date: 6/18/2016
 * Time: 1:34 PM
 */

namespace App\Frontend\Controllers;

use Libraries\ControllerBase;
use Libraries\HttpStatusCode;
use OauthClients;
use Phalcon\Http\Request;
use Phalcon\Http\Response;

class IndexController extends ControllerBase
{
    public function indexAction()
    {
        $oauth_users = OauthClients::findFirst();
        $this->response($oauth_users, HttpStatusCode::NOT_FOUND);
    }

    public function tokenAction()
    {
        $server = $this->oauth;
        $server->handleTokenRequest(\OAuth2\Request::createFromGlobals())->send();
    }

    public function authorizeAction()
    {
        $request = \OAuth2\Request::createFromGlobals();
        $response = new \OAuth2\Response();

        $server = $this->oauth;

        if (!$server->validateAuthorizeRequest($request, $response)) {
            $this->response($response->getResponseBody(), $response->getStatusCode());
            return;
        }

        $is_authorized = ($request->request('is_authorized') === 'yes');

        $server->handleAuthorizeRequest($request, $response, true);

        if ($is_authorized) {
            $code = substr($response->getHttpHeader('Location'), strpos($response->getHttpHeader('Location'), 'code=')+5, 40);
            $this->response($code, HttpStatusCode::OK);
            return;
        }

        $response->send();
    }

    public function resourceAction()
    {
        $request = \OAuth2\Request::createFromGlobals();
        $response = new \OAuth2\Response();

        $server = $this->oauth;

        if (!$server->verifyResourceRequest($request, $response)) {
            $this->response($response->getResponseBody(), $response->getStatusCode());
            return;
        }

        $token = $server->getAccessTokenData($request, $response);
        $this->response($token, $response->getStatusCode());
    }

    public function callbackAction()
    {
        $request = \OAuth2\Request::createFromGlobals();
        $code = $request->request('code');
    }

    public function testAction()
    {
        echo 'Module Frontend ' . getenv('DB_ADAPTER');
    }
}
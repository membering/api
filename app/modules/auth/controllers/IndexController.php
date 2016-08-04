<?php
/**
 * Created by PhpStorm.
 * User: HOME
 * Date: 6/18/2016
 * Time: 1:34 PM
 */

namespace App\Auth\Controllers;

use Libraries\ControllerBase;
use Libraries\HttpStatusCode;

class IndexController extends ControllerBase
{
    public function tokenAction()
    {
        $request = \OAuth2\Request::createFromGlobals();
        $response = new \OAuth2\Response();

        $server = $this->oauth;
        $server->handleTokenRequest($request, $response)->send();
    }

    public function authorizeAction()
    {
        $request = \OAuth2\Request::createFromGlobals();
        $response = new \OAuth2\Response();

        $server = $this->oauth;

        if (!$server->validateAuthorizeRequest($request, $response)) {
            $this->response($response->getResponseBody(), $response->getStatusCode());
        }

        $is_authorized = ($request->request('is_authorized') === 'yes');

        $server->handleAuthorizeRequest($request, $response, true);

        if ($is_authorized) {
            $code = substr($response->getHttpHeader('Location'), strpos($response->getHttpHeader('Location'), 'code=')+5, 40);
            $this->response($code, HttpStatusCode::OK);
        }

        $response->send();
    }

    public function resourceAction()
    {
        $request = \OAuth2\Request::createFromGlobals();
        $response = new \OAuth2\Response();

        $server = $this->oauth;

        $token = $server->getAccessTokenData($request, $response);
        $this->response($token, $response->getStatusCode());
    }

    public function callbackAction()
    {
        $request = \OAuth2\Request::createFromGlobals();
        $code = $request->request('code');
    }
}
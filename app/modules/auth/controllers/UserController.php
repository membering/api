<?php
/**
 * Created by PhpStorm.
 * User: HOME
 * Date: 7/21/2016
 * Time: 9:00 PM
 */

namespace App\Auth\Controllers;

use App\Auth\Validators\Register;
use Libraries\ControllerBase;
use Libraries\Exception;
use Libraries\HttpStatusCode;
use Phalcon\Http\Request;
use Users;

class UserController extends ControllerBase
{
    public function registerAction()
    {
        try {
            $request = new Request();
            if (!$request->isPost())
                throw new Exception('The method request is not allow', HttpStatusCode::METHOD_NOT_ALLOWED);

            $data = $request->getPost();

            $validator = new Register();
            $validator->validate($data);
            if (count($validator->getMessages()))
                throw new Exception($validator->getMessages(), HttpStatusCode::BAD_REQUEST);

            $user = new Users();
            $user->save($data);

            $this->response($data);
        }
        catch (\Exception $e) {
            $this->response($e->getMessage(), $e->getCode());
        }
    }

    public function loginAction()
    {
        try {
            $request = new Request();
            if (!$request->isPost())
                throw new Exception('The method request is not allow', HttpStatusCode::METHOD_NOT_ALLOWED);

            $data = $request->getPost();

            $validator = new Register();
            $validator->validate($data);
            if (count($validator->getMessages()))
                throw new Exception($validator->getMessages(), HttpStatusCode::BAD_REQUEST);

            $user = Users::findFirst([
                'conditions' => 'email = ?0 AND password = ?1',
                'bind' => [$data['email'], $data['password']]
            ]);
            if (!$user)
                throw new Exception('Email or Password is invalid', HttpStatusCode::NOT_ACCEPTABLE);

            $this->response($user);
        }
        catch (\Exception $e) {
            $this->response($e->getMessage(), $e->getCode());
        }
    }

    public function logoutAction()
    {

    }
}
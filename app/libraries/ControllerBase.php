<?php
/**
 * Created by PhpStorm.
 * User: HOME
 * Date: 6/18/2016
 * Time: 5:35 PM
 */

namespace Libraries;

use LogRequests;
use Phalcon\Http\Response;
use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    public function initialize()
    {
        $module = $this->dispatcher->getModuleName();
        $controller = $this->dispatcher->getControllerName();
        $action = $this->dispatcher->getActionName();

        if ($module == 'auth' && $controller == 'index' && $action == 'token') {
        }
        else {
            $server = $this->oauth;
            if (!$server->verifyResourceRequest(\OAuth2\Request::createFromGlobals())) {
                $this->response('Un-authorized', HttpStatusCode::UNAUTHORIZED);
            }
        }
    }

    public function response($content = null, $status = HttpStatusCode::OK)
    {
        $response = new Response();

        try {
            $response->setStatusCode($status);
        } catch (\Exception $e) {
            $status = HttpStatusCode::CONFLICT;
            $response->setStatusCode($status);
        }
        $array['status'] = $status;

        if (!empty($content)) {
            $content = $this->handleContent($content);
            if ($status == HttpStatusCode::OK) $array['data'] = $content;
            else $array['message'] = $content;
        }

        $response->setJsonContent($array);
        $response->send();

        $this->setLog($array);

        exit();
    }

    private function setLog($output) {
        try {
            $request = $this->request;
            $input = $request->get();
            array_shift($input);

            $log = new LogRequests();
            $log->uri = $request->getURI();
            $log->method = $request->getMethod();
            $log->input = json_encode($input);
            $log->output = json_encode($output);
            $log->save();
        } catch (\Exception $e) {}
    }

    private function handleContent($string) {
        if (is_string($string) && is_array(json_decode($string, true))) return json_decode($string, true);
        return $string;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: COMPANY
 * Date: 7/26/2016
 * Time: 3:43 PM
 */

namespace Libraries;

class Exception extends \Exception
{
    public function __construct($message = null, $code = 0, Exception $previous = null)
    {
        if (is_array($message)) {
            $message = json_encode($message);
        }
        parent::__construct($message, $code, $previous);
    }
}
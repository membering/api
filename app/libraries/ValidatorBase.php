<?php
/**
 * Created by PhpStorm.
 * User: COMPANY
 * Date: 7/26/2016
 * Time: 3:11 PM
 */

namespace Libraries;

use Phalcon\Validation;

class ValidatorBase extends Validation
{
    public function getMessages() {
        $messages = [];
        foreach (parent::getMessages() as $message) {
            $messages[$message->getField()] = $message->getMessage();
        }
        return $messages;
    }
}
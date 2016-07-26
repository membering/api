<?php
/**
 * Created by PhpStorm.
 * User: COMPANY
 * Date: 7/26/2016
 * Time: 3:07 PM
 */

namespace App\Auth\Validators;

use Libraries\ValidatorBase;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;

class Register extends ValidatorBase
{
    public function initialize()
    {
        $this->add('email',
            new PresenceOf(array(
                    'message' => 'Required'
                )
            )
        );
        $this->add('email',
            new Email(array(
                    'message' => 'Invalid'
                )
            )
        );
        $this->add('password',
            new PresenceOf(array(
                    'message' => 'Required'
                )
            )
        );
    }
}
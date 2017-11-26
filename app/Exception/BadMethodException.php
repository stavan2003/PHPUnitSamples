<?php

namespace App\Exception;

/**
 * Created by PhpStorm.
 * User: stavan.shah
 * Date: 11/19/2017
 * Time: 8:04 PM
 */
class BadMethodException extends \Exception
{
    // Redefine the exception so message isn't optional
    public function __construct($message, $code = 0, Exception $previous = null) {
        // some code

        // make sure everything is assigned properly
        parent::__construct($message, $code, $previous);
    }

    // custom string representation of object
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

}
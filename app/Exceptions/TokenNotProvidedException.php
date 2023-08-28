<?php

namespace App\Exceptions;

use Exception;

class TokenNotProvidedException extends Exception
{
    protected $message = 'Token not provided';
}

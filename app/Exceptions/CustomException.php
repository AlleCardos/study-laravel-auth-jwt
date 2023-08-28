<?php

namespace App\Exceptions;

use Exception;

class CustomException extends Exception
{
    public function render()
    {
        return response()->json(['message' => 'fudeu'], 401);
    }
}

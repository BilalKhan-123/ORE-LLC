<?php

namespace App\Exceptions;

use Exception;
use App\Traits\ApiResponser;

class CustomErrorException extends Exception
{
    use ApiResponser;

    private $errorMsg;

    public function __construct(string $message, int $code = 400)
    {
        $this->errorMsg = $message;
        $this->code = $code;
    }

    public function report()
    {
        return '';
    }

    public function render()
    {
        return $this->error([
            'message' => $this->errorMsg,
        ], $this->code);
    }
}

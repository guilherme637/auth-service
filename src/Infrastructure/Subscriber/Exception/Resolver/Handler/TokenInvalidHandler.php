<?php

namespace App\Infrastructure\Subscriber\Exception\Resolver\Handler;

use App\Infrastructure\Subscriber\Exception\Custom\TokenInvalidExecption;

class TokenInvalidHandler extends CustomExceptionHandler
{
    public function shoudCall(\Throwable $throwable): bool
    {
        return $throwable instanceof TokenInvalidExecption;
    }
}
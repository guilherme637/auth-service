<?php

namespace App\Infrastructure\Validator\Constraint\Authorize;

use App\Infrastructure\Validator\ConstraintValidator\Authorize\ResponseTypeValidator;
use Symfony\Component\Validator\Constraint;

class ResponseTypeInvalidConstraint extends Constraint
{
    public string $message = 'unsupported response type';

    public function validatedBy(): string
    {
        return ResponseTypeValidator::class;
    }
}
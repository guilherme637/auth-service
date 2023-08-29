<?php

namespace App\Infrastructure\Validator\Constraint\Login;

use App\Infrastructure\Validator\ConstraintValidator\Login\TokenValidator;
use Symfony\Component\Validator\Constraint;

class TokenInvalidConstraint extends Constraint
{
    public string $message = 'You can not do this.';

    public function validatedBy(): string
    {
        return TokenValidator::class;
    }
}
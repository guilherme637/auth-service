<?php

namespace App\Infrastructure\Validator\Constraint\Login;

use App\Infrastructure\Validator\ConstraintValidator\Login\PasswordValidator;
use Symfony\Component\Validator\Constraint;

class PasswordInvalidConstraint extends Constraint
{
    public string $message = 'Password or Email invalid';

    public function validatedBy(): string
    {
        return PasswordValidator::class;
    }
}
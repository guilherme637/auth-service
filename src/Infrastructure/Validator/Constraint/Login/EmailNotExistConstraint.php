<?php

namespace App\Infrastructure\Validator\Constraint\Login;

use App\Infrastructure\Validator\ConstraintValidator\Login\EmailValidator;
use Symfony\Component\Validator\Constraint;

class EmailNotExistConstraint extends Constraint
{
    public string $message = 'Password or Email invalid';

    public function validatedBy(): string
    {
        return EmailValidator::class;
    }
}
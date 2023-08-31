<?php

namespace App\Infrastructure\Validator\Constraint\Token;

use App\Infrastructure\Validator\ConstraintValidator\Token\GrantTypeValidator;
use Symfony\Component\Validator\Constraint;

class GrantTypeInvalidConstraint extends Constraint
{
    public string $message = 'grant_type invalid';

    public function validatedBy(): string
    {
        return GrantTypeValidator::class;
    }
}
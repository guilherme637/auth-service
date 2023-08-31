<?php

namespace App\Infrastructure\Validator\Constraint\Token;

use App\Infrastructure\Validator\ConstraintValidator\Token\CodeValidator;
use Symfony\Component\Validator\Constraint;

class CodeExpireConstraint extends Constraint
{
    public string $message = 'access denied';

    public function validatedBy(): string
    {
        return CodeValidator::class;
    }
}
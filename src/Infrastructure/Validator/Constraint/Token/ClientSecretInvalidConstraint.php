<?php

namespace App\Infrastructure\Validator\Constraint\Token;

use App\Infrastructure\Validator\ConstraintValidator\Token\ClientSecretValidator;
use Symfony\Component\Validator\Constraint;

class ClientSecretInvalidConstraint extends Constraint
{
    public string $message = 'unauthorized client';

    public function validatedBy(): string
    {
        return ClientSecretValidator::class;
    }
}
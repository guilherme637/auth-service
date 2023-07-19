<?php

namespace App\Infrastructure\Validator\Constraint\Authorize;

use App\Infrastructure\Validator\ConstraintValidator\Authorize\ClientValidator;
use Symfony\Component\Validator\Constraint;

class ClientIdInvalidConstraint extends Constraint
{
    public string $message = 'unauthorized client';

    public function validatedBy(): string
    {
        return ClientValidator::class;
    }
}
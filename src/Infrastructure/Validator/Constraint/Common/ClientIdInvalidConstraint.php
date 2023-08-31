<?php

namespace App\Infrastructure\Validator\Constraint\Common;

use App\Infrastructure\Validator\ConstraintValidator\Common\ClientValidator;
use Symfony\Component\Validator\Constraint;

class ClientIdInvalidConstraint extends Constraint
{
    public string $message = 'unauthorized client';

    public function validatedBy(): string
    {
        return ClientValidator::class;
    }
}
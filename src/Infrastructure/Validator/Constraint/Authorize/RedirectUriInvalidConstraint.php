<?php

namespace App\Infrastructure\Validator\Constraint\Authorize;

use App\Infrastructure\Validator\ConstraintValidator\Authorize\RedirectUriValidator;
use Symfony\Component\Validator\Constraint;

class RedirectUriInvalidConstraint extends Constraint
{
    public string $message = 'invalid uri redirect';

    public function validatedBy(): string
    {
        return RedirectUriValidator::class;
    }
}
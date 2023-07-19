<?php

namespace App\Infrastructure\Validator\ConstraintValidator\Authorize;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ResponseTypeValidator extends ConstraintValidator
{
    private const RESPONSE_TYPE = 'code';

    public function validate($value, Constraint $constraint)
    {
        if ($value !== self::RESPONSE_TYPE) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('response_type', $value)
                ->addViolation()
            ;
        }
    }
}
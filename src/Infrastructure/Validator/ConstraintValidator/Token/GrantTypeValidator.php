<?php

namespace App\Infrastructure\Validator\ConstraintValidator\Token;

use App\Presentation\DTO\Token\TokenRequest;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class GrantTypeValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if ($value !== TokenRequest::GRANT_TYPE) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('grant_type', $value)
                ->addViolation()
            ;
        }
    }
}
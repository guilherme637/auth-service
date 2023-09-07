<?php

namespace App\Infrastructure\Validator\ConstraintValidator\Login;

use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class TokenValidator extends ConstraintValidator
{
    public function __construct(private CsrfTokenManagerInterface $csrfTokenManager) {}

    public function validate($value, Constraint $constraint)
    {
        if (!$this->csrfTokenManager->isTokenValid(new CsrfToken('login', $value))) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('_token', $value)
                ->addViolation()
            ;
        }
    }
}
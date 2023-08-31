<?php

namespace App\Infrastructure\Validator\ConstraintValidator\Login;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class TokenValidator extends ConstraintValidator
{
    public function __construct(private SessionInterface $session) {}

    public function validate($value, Constraint $constraint)
    {
        if ($this->session->get('_token') !== $value) {
            $this->session->remove('_token');

            $this->context->buildViolation($constraint->message)
                ->setParameter('_token', $value)
                ->addViolation()
            ;
        }

        $this->session->remove('_token');
    }
}
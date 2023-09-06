<?php

namespace App\Infrastructure\Validator\ConstraintValidator\Login;

use App\Infrastructure\Repository\UsersRepository;
use App\Presentation\DTO\Login\LoginRequest;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class PasswordValidator extends ConstraintValidator
{
    public function __construct(private UsersRepository $usersRepository) {}

    public function validate($value, Constraint $constraint)
    {
        /** @var LoginRequest $login */
        $login = $this->context->getObject();

        if (
            !password_verify($value, $this->usersRepository->getPasswordByEmail($login->getEmail()))
        ) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('password', $value)
                ->addViolation()
            ;
        }
    }
}
<?php

namespace App\Infrastructure\Validator\ConstraintValidator\Login;

use App\Infrastructure\Repository\UsersRepository;
use App\Presentation\DTO\Login\LoginRequest;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\Email;

class EmailValidator extends \Symfony\Component\Validator\Constraints\EmailValidator
{
    public function __construct(private UsersRepository $usersRepository)
    {
        parent::__construct(Email::VALIDATION_MODE_STRICT);
    }

    public function validate($value, Constraint $constraint)
    {
        /** @var LoginRequest $login */
        $login = $this->context->getObject();
        $user = $this->usersRepository->getEmail($login->getEmail());

        if (is_null($user)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('email', $value)
                ->addViolation()
            ;
        }
    }
}
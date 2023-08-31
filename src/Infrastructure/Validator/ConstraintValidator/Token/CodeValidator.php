<?php

namespace App\Infrastructure\Validator\ConstraintValidator\Token;

use App\Infrastructure\Repository\UsersRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CodeValidator extends ConstraintValidator
{
    private const TEMPO_PERMITIDO_CODE = 1;

    public function __construct(private UsersRepository $usersRepository) {}

    public function validate($value, Constraint $constraint)
    {
        $code = $this->usersRepository->getCode($value);
        /** @var \DateInterval $timeCode */
        $timeCode = $code['dtCode']->diff(new \DateTime('now'));

        if ($timeCode->i >= self::TEMPO_PERMITIDO_CODE) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('code', $value)
                ->addViolation()
            ;
        }
    }
}
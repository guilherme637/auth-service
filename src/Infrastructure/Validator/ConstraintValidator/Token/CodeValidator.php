<?php

namespace App\Infrastructure\Validator\ConstraintValidator\Token;

use App\Domain\Adapter\Redis\RedisAdapterInterface;
use App\Infrastructure\Repository\UsersRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CodeValidator extends ConstraintValidator
{
    private const TEMPO_PERMITIDO_CODE = -2;

    public function __construct(
        private readonly UsersRepository $usersRepository,
        private readonly RedisAdapterInterface $redisAdapter
    ) {}

    public function validate($value, Constraint $constraint)
    {
        $key = $this->usersRepository->getEmailByCode($value);
        $code = $this->redisAdapter->get($key);

        if (
            $code !== $value
            || $this->redisAdapter->getTtl($key) === self::TEMPO_PERMITIDO_CODE
        ) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('code', $value)
                ->addViolation()
            ;
        }
    }
}
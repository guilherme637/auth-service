<?php

namespace App\Infrastructure\Validator\ConstraintValidator\Common;

use App\Domain\Service\RedirectUri\RedirectUriServiceInterface;
use App\Presentation\DTO\Authorize\AuthorizeRequest;
use App\Presentation\DTO\Token\TokenRequest;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class RedirectUriValidator extends ConstraintValidator
{
    public function __construct(private RedirectUriServiceInterface $uriService) {}

    public function validate($value, Constraint $constraint)
    {
        /** @var AuthorizeRequest|TokenRequest $authorizeDto */
        $dto = $this->context->getObject();

        if ($this->uriService->checkClientId($dto->getClientId())) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('redirect_uri', $value ?? 'redirect_uri')
                ->addViolation()
            ;
        }
    }
}
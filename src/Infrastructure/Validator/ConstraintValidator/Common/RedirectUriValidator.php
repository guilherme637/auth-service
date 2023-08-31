<?php

namespace App\Infrastructure\Validator\ConstraintValidator\Common;

use App\Domain\Entity\RedirectUri;
use App\Infrastructure\Service\RedirectUriService;
use App\Presentation\Authorize\DTO\AuthorizeRequest;
use App\Presentation\Authorize\DTO\TokenRequest;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class RedirectUriValidator extends ConstraintValidator
{
    public function __construct(private RedirectUriService $uriService) {}

    public function validate($value, Constraint $constraint)
    {
        /** @var AuthorizeRequest|TokenRequest $authorizeDto */
        $dto = $this->context->getObject();
        $uriRedirect = $this->uriService->getUriByClientId($dto->getClientId());

        $hasRedirect = $uriRedirect->exists(function (int $index, RedirectUri $redirectUri) use ($value) {
            return $redirectUri->getUriRedirect() === $value;
        });

        if (is_null($uriRedirect) || !$hasRedirect) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('redirect_uri', $value ?? 'redirect_uri')
                ->addViolation()
            ;
        }
    }
}
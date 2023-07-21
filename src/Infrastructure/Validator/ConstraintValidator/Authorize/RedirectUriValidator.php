<?php

namespace App\Infrastructure\Validator\ConstraintValidator\Authorize;

use App\Infrastructure\Service\RedirectUriService;
use App\Presentation\Authorize\DTO\AuthorizeRequest;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class RedirectUriValidator extends ConstraintValidator
{
    public function __construct(private RedirectUriService $uriService) {}

    public function validate($value, Constraint $constraint)
    {
        /** @var AuthorizeRequest $authorizeDto */
        $authorizeDto = $this->context->getObject();
        $uriRedirect = $this->uriService->getUriByClientId($authorizeDto->getClientId());

        if (is_null($uriRedirect) || $uriRedirect->getUriRedirect() !== $value) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('redirect_uri', $value)
                ->addViolation()
            ;
        }
    }
}
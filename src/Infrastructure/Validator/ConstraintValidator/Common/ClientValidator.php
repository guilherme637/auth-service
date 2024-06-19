<?php

namespace App\Infrastructure\Validator\ConstraintValidator\Common;

use App\Infrastructure\Service\Client\ClientService;
use App\Presentation\DTO\Authorize\AuthorizeRequest;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ClientValidator extends ConstraintValidator
{
    public function __construct(private ClientService $clientService) {}

    public function validate($value, Constraint $constraint)
    {
        /** @var AuthorizeRequest $authorizeDto */
        $authorizeDto = $this->context->getObject();
        $clientId = $this->clientService->getClientByClientId($authorizeDto->getClientId());

        if (is_null($clientId)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('client_id', $value)
                ->addViolation()
            ;
        }
    }
}
<?php

namespace App\Infrastructure\Validator\ConstraintValidator\Token;

use App\Infrastructure\Service\ClientService;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ClientSecretValidator extends ConstraintValidator
{
    public function __construct(private ClientService $clientService) {}

    public function validate($value, Constraint $constraint)
    {
        $clientId = $this->clientService->getClientSecretByClientId($value);

        if (is_null($clientId)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('client_id', $value)
                ->addViolation()
            ;
        }
    }
}
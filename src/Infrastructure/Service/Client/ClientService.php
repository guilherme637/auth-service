<?php

namespace App\Infrastructure\Service\Client;

use App\Domain\Entity\Client;
use App\Infrastructure\Repository\ClientRepository;

class ClientService implements ClientServiceInterface
{
    public function __construct(private ClientRepository $clientRepository) {}

    public function getClientByClientId(string $clientId): ?Client
    {
        return $this->clientRepository->findOneBy(['clientId' => $clientId]);
    }

    public function getClientSecretByClientId(string $clientSecret): ?Client
    {
        return $this->clientRepository->findOneBy(['clientSecret' => $clientSecret]);
    }
}
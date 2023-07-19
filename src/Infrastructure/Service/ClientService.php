<?php

namespace App\Infrastructure\Service;

use App\Domain\Entity\Client;
use App\Infrastructure\Repository\ClientRepository;

class ClientService
{
    public function __construct(private ClientRepository $clientRepository) {}

    public function getClientByClientId(string $clientId): ?Client
    {
        return $this->clientRepository->findOneBy(['clientId' => $clientId]);
    }
}
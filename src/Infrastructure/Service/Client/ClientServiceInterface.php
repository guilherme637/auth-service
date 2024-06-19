<?php

namespace App\Infrastructure\Service\Client;

use App\Domain\Entity\Client;

interface ClientServiceInterface
{
    public function getClientByClientId(string $clientId): ?Client;
    public function getClientSecretByClientId(string $clientSecret): ?Client;
}
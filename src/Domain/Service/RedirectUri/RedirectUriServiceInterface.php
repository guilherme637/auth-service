<?php

namespace App\Domain\Service\RedirectUri;

interface RedirectUriServiceInterface
{
    public function checkClientId(string $clientId): bool;
}
<?php

namespace App\Infrastructure\Service;

use App\Domain\Entity\RedirectUri;
use App\Infrastructure\Repository\RedirectUriRepository;

class RedirectUriService
{
    public function __construct(private RedirectUriRepository $redirectUriRepository){}

    public function getUriByClientId(string $clientId): ?RedirectUri
    {
        return $this->redirectUriRepository->getUriByClientId($clientId);
    }
}
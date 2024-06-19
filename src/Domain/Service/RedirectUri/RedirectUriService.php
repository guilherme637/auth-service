<?php

namespace App\Domain\Service\RedirectUri;

use App\Domain\Entity\RedirectUri;
use App\Infrastructure\Repository\RedirectUriRepository;

class RedirectUriService implements RedirectUriServiceInterface
{
    public function __construct(private RedirectUriRepository $redirectUriRepository){}

    public function checkClientId(string $clientId): bool
    {
        $uri = $this->redirectUriRepository->getUriByClientId($clientId);

        if ($uri->isEmpty()) {
            return false;
        }

        return $uri->exists(function (int $index, RedirectUri $redirectUri) use ($clientId) {
            return $redirectUri->getUriRedirect() === $clientId;
        });
    }
}
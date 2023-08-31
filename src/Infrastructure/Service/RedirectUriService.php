<?php

namespace App\Infrastructure\Service;

use App\Domain\Entity\RedirectUri;
use App\Infrastructure\Repository\RedirectUriRepository;
use Doctrine\Common\Collections\ArrayCollection;

class RedirectUriService
{
    public function __construct(private RedirectUriRepository $redirectUriRepository){}

    public function getUriByClientId(string $clientId): ArrayCollection
    {
        return $this->redirectUriRepository->getUriByClientId($clientId);
    }
}
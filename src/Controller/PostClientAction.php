<?php

namespace App\Controller;

use App\Domain\Entity\Client;
use App\Domain\Entity\ClientScope;
use App\Domain\Entity\RedirectUri;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/client', name: 'create_client', methods: ['POST'])]
class PostClientAction
{
    public function __invoke(EntityManagerInterface $entityManager)
    {
        $client = new Client();
        $clientScopeCreate = new ClientScope();
        $clientScopeCreate->setClientId($client);
        $clientScopeCreate->setDsScope('create');

        $clientScopeRead = new ClientScope();
        $clientScopeRead->setClientId($client);
        $clientScopeRead->setDsScope('read');

        $redirectUri = new RedirectUri();
        $redirectUri->setClientId($client);
        $redirectUri->setUriRedirect('https://financas.com.br:3030/check');
        $entityManager->persist($clientScopeRead);
        $entityManager->persist($clientScopeCreate);
        $entityManager->persist($redirectUri);
        $client->setClientId(hash('sha512', base64_encode('financas') . '[/\13;.13]'));
        $client->setClientName('Finanças');
        $client->setClientSecret(hash('sha512','[f\i/n\a/n\c/a\s/]'));
        $client->setClientSecretExpiresAt((new \DateTime('now'))->add(new \DateInterval('P1Y')));
        $client->setClientIdIssuedAt(new \DateTime('now'));
        $client->setTokenEndpointAuthMethod('client_secret_post');
        $client->setGrantType('authorization_code');

        $entityManager->persist($clientScopeCreate);
        $entityManager->persist($clientScopeRead);
        $entityManager->persist($redirectUri);
        $entityManager->persist($client);
        $entityManager->flush();
    }
}
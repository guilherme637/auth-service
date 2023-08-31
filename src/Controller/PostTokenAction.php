<?php

namespace App\Controller;

use App\Domain\Adapter\Serializer\SerializerInterface;
use App\Domain\Adapter\Validator\ValidatorAdapterInterface;
use App\Infrastructure\Service\ClientService;
use App\Infrastructure\Utils\Crypt;
use App\Presentation\Authorize\DTO\TokenRequest;
use Firebase\JWT\JWT;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PostTokenAction
{
    public function __construct(
        private SerializerInterface $serializer,
        private ValidatorAdapterInterface $validator,
        private ClientService $clientService,
        private Crypt $crypt
    ) {}

    #[Route('/token', name: 'app_posttokenaction__invoke', methods: ['POST'])]
    public function __invoke(Request $request)
    {
//        $this->crypt->generateRSA('financas');
        /** @var TokenRequest $tokenRequest */
        $tokenRequest = $this->serializer->fromArray($request->request->all(), TokenRequest::class);
        $this->validator->validate($tokenRequest);

        $client = $this->clientService->getClientByClientId($tokenRequest->getClientId());
        $privateKey = file_get_contents('/var/www/html/auth-service/config/infrastructure/certificado/financas/private-key.pem');
        $publicKey = file_get_contents('/var/www/html/auth-service/config/infrastructure/certificado/financas/public-key.pem');

        $payload = [
            'iss' => 'authservice',
            'aud' => 'financas.com.br',
            'iat' => 1356999524
        ];

        $pkeyid = openssl_pkey_get_private(file_get_contents("/var/www/html/auth-service/config/infrastructure/certificado/financas/private-key.pem"));

        $jwt = JWT::encode($payload, $pkeyid, 'RS256');
        dump('salvar o passphrase no banco ou em algum lugar para poder pegar a chave openssl_pkey_get_private e gerar o jwt');
        exit();
    }
}
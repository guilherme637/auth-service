<?php

namespace App\Controller;

use App\Domain\Adapter\HTMLPurify\HtmlPurifyAdapter;
use App\Domain\Adapter\Serializer\SerializerInterface;
use App\Domain\Adapter\Validator\ValidatorAdapterInterface;
use App\Infrastructure\Repository\UsersRepository;
use App\Infrastructure\Service\ClientService;
use App\Infrastructure\Utils\Crypt;
use App\Presentation\Authorize\DTO\TokenRequest;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PostTokenAction
{
    public function __construct(
        private SerializerInterface $serializer,
        private ValidatorAdapterInterface $validator,
        private ClientService $clientService,
        private UsersRepository $usersRepository,
        private Crypt $crypt
    ) {}

    #[Route('/token', name: 'app_posttokenaction__invoke', methods: ['POST'])]
    public function __invoke(Request $request)
    {
        $purify = (new HtmlPurifyAdapter())->purifyFromArray($request->request->all());
        /** @var TokenRequest $tokenRequest */
        $tokenRequest = $this->serializer->fromArray($purify, TokenRequest::class);
        $this->validator->validate($tokenRequest);

        $client = $this->clientService->getClientByClientId($tokenRequest->getClientId());
        $user = $this->usersRepository->getUserByCode($tokenRequest->getCode());
        $exp = time() + (60 * 60);

        $payload = [
            "iss" => 'http://auth-service.com.br:3030',
            "exp" => $exp,
            "aud" => 'api:' . $client->getClientName(),
            "sub" => $user->getId(),
            "client_id" => $client->getClientId(),
            "iat" => time(),
            "scope" => "read write"
        ];

        $path = '/var/www/html/auth-service/config/infrastructure/certificado/' . $client->getClientName() . '/';
        $privateKey = $path . 'private-key.pem';
        $pkeyid = openssl_pkey_get_private(file_get_contents($privateKey),file_get_contents($path . 'passphrase.txt'));

        $jwt = JWT::encode($payload, $pkeyid, 'RS256');

        return new JsonResponse(["access_token" => $jwt]);
    }
}
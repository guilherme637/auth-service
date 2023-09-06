<?php

namespace App\Infrastructure\Service;

use App\Infrastructure\Assembler\TokenAssembler;
use App\Infrastructure\Utils\Crypt;
use App\Presentation\DTO\Token\TokenRequest;
use App\Presentation\DTO\Token\TokenResponse;
use Firebase\JWT\JWT;

class TokenService
{
    private const ALG = 'RS256';

    public function __construct(private ClientService $clientService, private UserService $userService) {}

    public function generateToken(TokenRequest $tokenRequest): TokenResponse
    {
        $client = $this->clientService->getClientByClientId($tokenRequest->getClientId());
        $user = $this->userService->getUserByCode($tokenRequest->getCode());

        $assemblerTokenResponse = TokenAssembler::assemblerTokenResponse($client, $user);

        return new TokenResponse(JWT::encode($assemblerTokenResponse, Crypt::getKeyToJwt($client), self::ALG));
    }
}
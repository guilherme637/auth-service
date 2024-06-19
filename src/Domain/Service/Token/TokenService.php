<?php

namespace App\Domain\Service\Token;

use App\Domain\Service\User\UserServiceInterface;
use App\Infrastructure\Assembler\TokenAssembler;
use App\Infrastructure\Service\Client\ClientService;
use App\Presentation\DTO\Token\TokenRequest;
use App\Presentation\DTO\Token\TokenResponse;
use Auth\Token;

class TokenService implements TokenServiceInterface
{
    private const ALG = 'RS256';

    public function __construct(
        private ClientService $clientService,
        private UserServiceInterface $userService
    ) {}

    public function generateToken(TokenRequest $tokenRequest): TokenResponse
    {
        $client = $this->clientService->getClientByClientId($tokenRequest->getClientId());
        $user = $this->userService->getUserByCode($tokenRequest->getCode());

        $assemblerTokenResponse = TokenAssembler::assemblerTokenResponse($client, $user);

        return new TokenResponse(
            Token::getJwt($assemblerTokenResponse, $client->getClientName())
        );
    }
}
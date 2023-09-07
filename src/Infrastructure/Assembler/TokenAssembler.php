<?php

namespace App\Infrastructure\Assembler;

use App\Domain\Entity\Client;
use App\Domain\Entity\Users;
use App\Domain\Enum\UrlEnum;

class TokenAssembler
{
    public static function assemblerTokenResponse(Client $client, Users $users): array
    {
        return [
            'iss' => UrlEnum::HOST->value,
            'exp' => time() + (60 * 60),
            'aud' => 'api:' . $client->getClientName(),
            'sub' => [
                'id' => $users->getId(),
                'username' => $users->getUsername(),
                'email' => $users->getEmail()
            ],
            'client_id' => $client->getClientId(),
            'iat' => time(),
            'scope' => $users->getScopes()->getDsScope()
        ];
    }
}
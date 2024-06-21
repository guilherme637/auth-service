<?php

namespace App\Domain\Service\Token;

use App\Presentation\DTO\Token\TokenRequest;
use App\Presentation\DTO\Token\TokenResponse;

interface TokenServiceInterface
{
    public function generateToken(TokenRequest $tokenRequest): TokenResponse;
}
<?php

namespace App\Domain\Service\Login;

interface LoginServiceInterface
{
    public function sanityzeHtml(array $form): array;
    public function getCode(string $email): string;
}
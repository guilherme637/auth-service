<?php

namespace App\Domain\Service\Login;

use App\Domain\Adapter\HTMLPurify\HtmlPurifyAdapter;
use App\Domain\Service\User\UserServiceInterface;

class LoginService implements LoginServiceInterface
{
    public function __construct(private UserServiceInterface $userService) {}

    public function sanityzeHtml(array $form): array
    {
        $purify = new HtmlPurifyAdapter();

        return $purify->purifyFromArray($form);
    }

    public function getCode(string $email): string
    {
        $code = base64_encode(
            bin2hex(
                random_bytes(16)
            )
        );

        $this->userService->updateCode($email, $code);

        return $code;
    }
}
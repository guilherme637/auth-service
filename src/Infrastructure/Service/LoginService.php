<?php

namespace App\Infrastructure\Service;

use App\Domain\Adapter\HTMLPurify\HtmlPurifyAdapter;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class LoginService
{
    public function __construct(private UserService $userService) {}

    public function authorize(Request $request)
    {
        return new RedirectResponse('http://auth-service.com.br:3030/teste');
    }

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
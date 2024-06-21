<?php

namespace App\Controller;

use App\Domain\Adapter\Serializer\SerializerInterface;
use App\Domain\Adapter\Validator\ValidatorAdapterInterface;
use App\Domain\Service\Login\LoginServiceInterface;
use App\Presentation\DTO\Authorize\AuthorizeRequest;
use App\Presentation\DTO\Login\LoginRequest;
use App\Presentation\Templates\FormType\LoginFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GetLoginAction extends AbstractController
{
    public function __construct(
        private ValidatorAdapterInterface $validatorAdapter,
        private SerializerInterface $serializer,
        private LoginServiceInterface $loginService
    ) {}

    #[Route(path: '/login', methods: ['POST', 'GET'])]
    public function __invoke(Request $request)
    {
        $queryStringPurify = $this->loginService->sanityzeHtml($request->query->all());
        /** @var AuthorizeRequest $authorizeDto */
        $authorizeDto = $this->serializer->fromArray($queryStringPurify, AuthorizeRequest::class);
        $this->validatorAdapter->validate($authorizeDto);

        if ($request->getMethod() === 'POST') {
            $purifyHtml = $this->loginService->sanityzeHtml($request->get('login_form'));
            /** @var LoginRequest $login */
            $login = $this->serializer->fromArray($purifyHtml, LoginRequest::class);
            $this->validatorAdapter->validate($login);
            $request->getSession()->remove('error');

            return $login->doRedirect(
                $authorizeDto->getRedirectUri(),
                $authorizeDto->getState(),
                $this->loginService->getCode($login->getEmail())
            );
        }

        return $this->renderForm('base.html.twig', [
            'forms' => $this->createForm(LoginFormType::class),
            'error' => $request->getSession()->get('error') ?? null
        ]);
    }
}
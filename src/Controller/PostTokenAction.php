<?php

namespace App\Controller;

use App\Domain\Adapter\HTMLPurify\HtmlPurifyAdapter;
use App\Domain\Adapter\Serializer\SerializerInterface;
use App\Domain\Adapter\Validator\ValidatorAdapterInterface;
use App\Infrastructure\Service\TokenService;
use App\Presentation\DTO\Token\TokenRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PostTokenAction
{
    public function __construct(
        private SerializerInterface $serializer,
        private ValidatorAdapterInterface $validator,
        private TokenService $tokenService
    ) {}

    #[Route('/token', name: 'app_posttokenaction__invoke', methods: ['POST'])]
    public function __invoke(Request $request): JsonResponse
    {
        $purify = (new HtmlPurifyAdapter())->purifyFromArray($request->request->all());
        /** @var TokenRequest $tokenRequest */
        $tokenRequest = $this->serializer->fromArray($purify, TokenRequest::class);
        $this->validator->validate($tokenRequest);

        return new JsonResponse(
            $this->serializer->toArray(
                $this->tokenService->generateToken($tokenRequest)
            )
        );
    }
}
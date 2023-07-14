<?php

namespace App\Controller;

use App\Domain\Adapter\Serializer\Serializer;
use App\Domain\Adapter\Serializer\SerializerInterface;
use App\Domain\Adapter\Validator\ValidatorAdapterInterface;
use App\Presentation\Authorize\DTO\AuthorizeRequest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/authorize', name: 'authorize_get_action', methods: ['GET'])]
class GetAuthorizeAction
{
    public function __construct(
        private ValidatorAdapterInterface $validatorAdapter,
        private SerializerInterface $serializer
    ) {
    }

    public function __invoke(Request $request)
    {
        $this->serializer->fromArra($request->query->all(), AuthorizeRequest::class);
        $authorizeDto = new AuthorizeRequest($request->query->all());
        $this->validatorAdapter->validate($authorizeDto);
        dump($authorizeDto);
        exit();
        exit();
    }
}
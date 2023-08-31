<?php

namespace App\Controller;

use App\Domain\Adapter\Serializer\SerializerInterface;
use App\Domain\Adapter\Validator\ValidatorAdapterInterface;
use App\Infrastructure\Utils\Crypt;
use App\Presentation\Authorize\DTO\AuthorizeRequest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/authorize', name: 'authorize_get_action', methods: ['GET'])]
class GetAuthorizeAction
{
    public function __construct(
        private ValidatorAdapterInterface $validatorAdapter,
        private SerializerInterface $serializer,
    ) {
    }

    public function __invoke(Request $request)
    {
        /** @var AuthorizeRequest $authorizeDto */
        $authorizeDto = $this->serializer->fromArray($request->query->all(), AuthorizeRequest::class);
        $this->validatorAdapter->validate($authorizeDto);

        return $authorizeDto->makeLogin();
    }
}
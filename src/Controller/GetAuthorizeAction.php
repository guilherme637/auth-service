<?php

namespace App\Controller;

use App\Domain\Adapter\Redis\RedisAdapterInterface;
use App\Domain\Adapter\Serializer\SerializerInterface;
use App\Domain\Adapter\Validator\ValidatorAdapterInterface;
use App\Presentation\DTO\Authorize\AuthorizeRequest;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/authorize', name: 'authorize_get_action', methods: ['GET'])]
class GetAuthorizeAction
{
    public function __construct(
        private ValidatorAdapterInterface $validatorAdapter,
        private SerializerInterface $serializer,
        private RedisAdapterInterface $redisAdapter
    ) {
    }

    public function __invoke(Request $request): RedirectResponse
    {
        /** @var AuthorizeRequest $authorizeDto */
        $authorizeDto = $this->serializer->fromArray($request->query->all(), AuthorizeRequest::class);
        $this->validatorAdapter->validate($authorizeDto);

        return $authorizeDto->makeLogin();
    }
}
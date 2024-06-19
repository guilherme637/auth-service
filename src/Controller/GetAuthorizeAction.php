<?php

namespace App\Controller;

use App\Domain\Adapter\Serializer\SerializerInterface;
use App\Domain\Adapter\Validator\ValidatorAdapterInterface;
use App\Domain\Enum\URIEnum;
use App\Domain\Enum\UrlEnum;
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
    ) {
    }

    public function __invoke(Request $request): RedirectResponse
    {
        /** @var AuthorizeRequest $authorizeDto */
        $authorizeDto = $this->serializer->fromArray($request->query->all(), AuthorizeRequest::class);
        $this->validatorAdapter->validate($authorizeDto);

        return new RedirectResponse(
            UrlEnum::HOST->value
            . sprintf(
                URIEnum::LOGIN->value,
                $authorizeDto->getResponseType(),
                $authorizeDto->getClientId(),
                $authorizeDto->getRedirectUri(),
                $authorizeDto->getScope(),
                $authorizeDto->getState()
            )
        );
    }
}
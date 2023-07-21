<?php

namespace App\Controller;

use App\Domain\Adapter\Serializer\Serializer;
use App\Domain\Adapter\Serializer\SerializerInterface;
use App\Domain\Adapter\Validator\ValidatorAdapterInterface;
use App\Presentation\Authorize\DTO\AuthorizeRequest;
use Symfony\Component\HttpFoundation\RedirectResponse;
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
        $authorizeDto = $this->serializer->fromArray($request->query->all(), AuthorizeRequest::class);
        $this->validatorAdapter->validate($authorizeDto);

        return new RedirectResponse(
            'http://auth-service.com.br:3030/login?'
            . $request->server->get('QUERY_STRING')
        );
        dump('fazer a validação do scope para saber se ele tem a permissão para isso');
        exit();
    }
}
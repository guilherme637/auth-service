<?php

namespace App\Controller;

use App\Domain\Adapter\Serializer\SerializerInterface;
use App\Domain\Adapter\Validator\ValidatorAdapterInterface;
use App\Infrastructure\Service\LoginService;
use App\Presentation\DTO\Authorize\AuthorizeRequest;
use App\Presentation\DTO\Login\LoginRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GetLoginAction extends AbstractController
{
    public function __construct(
        private ValidatorAdapterInterface $validatorAdapter,
        private SerializerInterface $serializer,
        private LoginService $loginService
    ) {}

    #[Route(path: '/login', methods: ['POST', 'GET'])]
    public function __invoke(Request $request)
    {
        /** @var AuthorizeRequest $authorizeDto */
        $authorizeDto = $this->serializer->fromArray($request->query->all(), AuthorizeRequest::class);
        $this->validatorAdapter->validate($authorizeDto);

        if ($request->getMethod() === 'POST') {
            $purifyHtml = $this->loginService->sanityzeHtml($request->request->get('form'));
            /** @var LoginRequest $login */
            $login = $this->serializer->fromArray($purifyHtml, LoginRequest::class);

            $this->validatorAdapter->validate($login);

            return $login->doRedirect(
                $authorizeDto->getRedirectUri(),
                $authorizeDto->getState(),
                $this->loginService->getCode($login->getEmail())
            );
        }


        return $this->render('base.html.twig', ['forms' => $this->getForm($authorizeDto, $request)]);
    }

    public function getForm(AuthorizeRequest $authorizeDto, Request $request): FormView
    {
        $options = [
            'required' => true,
            'attr' => [
                'class' => 'form-control'
            ]
        ];

        $time = new \DateTime('now');
        $hash = hash('sha256', $authorizeDto->getClientId() . $time->format('i:s'));
        $form = $this->createFormBuilder()
            ->add('email', EmailType::class, $options)
            ->add('password', PasswordType::class, $options)
            ->add('token', HiddenType::class, ['data' => $hash])
            ->setMethod('POST')
            ->getForm()
            ->createView();

        $request->getSession()->set('_token', $hash);

        return $form;
    }
}
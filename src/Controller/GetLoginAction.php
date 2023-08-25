<?php

namespace App\Controller;

use App\Domain\Adapter\HTMLPurify\HtmlPurifyAdapter;
use App\Domain\Adapter\Serializer\SerializerInterface;
use App\Domain\Adapter\Validator\ValidatorAdapterInterface;
use App\Domain\Entity\Users;
use App\Infrastructure\Repository\UsersRepository;
use App\Presentation\Authorize\DTO\AuthorizeRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GetLoginAction extends AbstractController
{
    public function __construct(
        private ValidatorAdapterInterface $validatorAdapter,
        private UsersRepository $usersRepository,
        private SerializerInterface $serializer
    ) {
    }

    #[Route(path: '/login', methods: ['POST', 'GET'])]
    public function __invoke(Request $request)
    {
        /** @var AuthorizeRequest $authorizeDto */
        $authorizeDto = $this->serializer->fromArray($request->query->all(), AuthorizeRequest::class);
        $this->validatorAdapter->validate($authorizeDto);

        $options = [
            'required' => true,
            'attr' => [
                'class' => 'form-control'
            ]
        ];

        $form = $this->createFormBuilder()
            ->add('email', EmailType::class, $options)
            ->add('password', PasswordType::class, $options)
            ->add('_token', HiddenType::class, ['data' => hash('sha256', $authorizeDto->getClientId())])
            ->getForm()
            ->createView()
        ;

        if ($request->isMethod('POST')) {
            $purify = new HtmlPurifyAdapter();
            $login = $purify->purifyFromArray($request->request->all()['form']);

            if ($login['_token'] !== hash('sha256', $authorizeDto->getClientId())) {
                throw new \Exception('fail');
            }

            /** @var Users $user */
            $user = $this->usersRepository->findOneBy(['email' => $login['email']]);
            password_verify($login['password'], $user->getPassword());
        }

        return $this->render('base.html.twig', ['forms' => $form]);
    }
}
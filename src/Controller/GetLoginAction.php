<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GetLoginAction extends AbstractController
{
    #[Route(path: '/login', methods: ['POST', 'GET'])]
    public function __invoke(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add('email', EmailType::class)
            ->add('password', PasswordType::class)
            ->getForm()->createView()
        ;

        if ($request->isMethod('POST')) {
            dump($request);
            exit();

        }
        //TODO ajustar no campos do form type e depois fazer as validações ncessarias
        return $this->render('base.html.twig', ['forms' => $form]);
    }
}
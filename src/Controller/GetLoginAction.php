<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GetLoginAction extends AbstractController
{
    #[Route(path: '/login')]
    public function __invoke()
    {
        return $this->render('base.html.twig');
    }
}
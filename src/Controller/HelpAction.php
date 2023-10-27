<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class HelpAction
{
    #[Route('/help')]
    public function __invoke()
    {
        return new JsonResponse('vai corinthians');
    }
}
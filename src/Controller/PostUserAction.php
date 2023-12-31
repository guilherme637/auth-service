<?php

namespace App\Controller;

use App\Domain\Entity\Users;
use App\Domain\Entity\UserScope;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostUserAction
{
    #[Route(path: '/users', methods: ['POST', 'GET'])]
    public function __invoke(ManagerRegistry $managerRegistry)
    {
        $scope = new UserScope();
        $scope->setDsScope('ROLE_USER');
        $managerRegistry->getManager()->persist($scope);

        $users = new Users();
        $users->setEmail('teste@teste.com');
        $users->setUsername('guilherme');
        $users->setPassword(password_hash("123mudar", PASSWORD_ARGON2I, ['cost' => 12]));
        $users->setScopes($scope);

        $managerRegistry->getManager()->persist($users);
        $managerRegistry->getManager()->flush();

        return new JsonResponse([], Response::HTTP_CREATED);
    }
}
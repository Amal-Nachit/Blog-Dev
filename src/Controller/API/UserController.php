<?php

namespace App\Controller\API;

use App\Entity\Article;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
#[Route('/api/user', name:"app_api_user_")]
class UserController extends AbstractController {
    #[Route('s', name:"index")]
    public function index(UserRepository $repository): JsonResponse {

        $article = $repository->findAll();
        return $this->json($article, 200, [], [
            'groups' => ['admin.users.index']
        ]);
    }

    #[Route('/{id}', name:"show", requirements: ['id' => '\d+'])]
    public function show(Article $article): JsonResponse {

        return $this->json($article, 200, [], [
            'groups' => ['admin.users.index, user.dashboard']
        ]);
    }

#[Route('/{id}/edit', name:"edit", requirements: ['id' => '\d+'])]
public function edit(): JsonResponse
{
    return $this->render('api/user/edit.html.twig', [
        'controller_name' => 'UserController',
    ]);
}
}
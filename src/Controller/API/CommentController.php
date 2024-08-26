<?php

namespace App\Controller\API;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/comment', name: 'app_api_comment')]
class CommentController extends AbstractController
{
    #[Route('s', name: 'index')]
    public function index(): JsonResponse
    {
        return $this->render('api/comment/index.html.twig', [
            'controller_name' => 'CommentController',
        ]);
    }

    #[Route('/new', name: 'new')]
    public function new(): JsonResponse
    {
        return $this->render('api/comment/new.html.twig', [
            'controller_name' => 'CommentController',
        ]);
    }

    #[Route('/{id}/edit', name: 'edit')]
    public function edit(): JsonResponse
    {
        return $this->render('api/comment/edit.html.twig', [
            'controller_name' => 'CommentController',
        ]);
    }

    #[Route('/{id}', name: 'delete')]
    public function delete(): JsonResponse
    {
        return $this->render('api/comment/delete.html.twig', [
            'controller_name' => 'CommentController',
        ]);
    }

}

<?php

namespace App\Controller\API;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;

#[Route('/api/article', name:'api_article_', methods: ["GET"])]
class ArticleController extends AbstractController {

    #[Route('s', name:'liste')]
    public function index(ArticleRepository $repository) {
        
        $article = $repository->findAll();
        return $this->json($article, 200, [], [
            'groups' => ['api_article_liste']
        ]);
    }

    #[Route('/api/article/{id}', name:'show', requirements: ['id' => Requirement::DIGITS])]
    public function show(Article $article) {

        return $this->json($article, 200, [], [
            'groups' => ['api_article_liste', 'api_article_show']
        ]);
    }
}
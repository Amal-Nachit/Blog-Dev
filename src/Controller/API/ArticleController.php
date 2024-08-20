<?php

namespace App\Controller\API;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class ArticleController extends AbstractController {

    #[Route('/api/article')]
    public function index(ArticleRepository $repository) {

        $article = $repository->findAll();
        return $this->json($article, 200, [], [
            'groups' => ['article.index']
        ]);
    }
}
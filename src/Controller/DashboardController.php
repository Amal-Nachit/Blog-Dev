<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(ArticleRepository $articleRepository, UserRepository $user): Response
    {
        $articles = $articleRepository->findAll();
        $user = $user->findAll();   

        $currentDate = new \DateTime();
        foreach ($articles as $article) {
            $interval = $currentDate->diff($article->getCreatedAt());
            $article->setTimeAgo($this->formatTimeAgo($interval));
        }

        return $this->render('dashboard/index.html.twig', [
            'articles' => $articles,
        ]);
    }

    private function formatTimeAgo(\DateInterval $interval): string
    {
        if ($interval->y > 0) {
            return 'Il y a ' . $interval->y . ' an' . ($interval->y > 1 ? 's' : '') ;
        }
        if ($interval->m > 0) {
            return 'Il y a ' . $interval->m . ' mois';
        }
        if ($interval->d > 0) {
            return 'Il y a ' . $interval->d . ' jour' . ($interval->d > 1 ? 's' : '') ;
        }
        if ($interval->h > 0) {
            return 'Il y a ' . $interval->h . ' heure' . ($interval->h > 1 ? 's' : '') ;
        }
        if ($interval->i > 0) {
            return 'Il y a ' . $interval->i . ' minute' . ($interval->i > 1 ? 's' : '') ;
        }

        return 'à l\'instant';
    }
}

<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ArticleRepository $articleRepository): Response
    {
        $homeArticle = $articleRepository
            ->find(1);

        $articles = $articleRepository->findAll();

        return $this->render('home/index.html.twig', [
            'articles' =>$articles,
            'homeArticle' => $homeArticle
        ]);
    }
}

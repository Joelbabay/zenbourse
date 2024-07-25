<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {

    }

    #[Route('/', name: 'app_home')]
    public function index(ArticleRepository $articleRepository): Response
    {
        $homeArticle = $articleRepository
            ->find(2);

        $articles = $articleRepository->findAll();

        return $this->render('home/index.html.twig', [
            'articles' =>$articles,
            'homeArticle' => $homeArticle
        ]);
    }

    #[Route('/methodes', name: 'app_methode')]
    public function method(): Response
    {
        return $this->render('home/method.html.twig');
    }

    #[Route('/le-perdant', name: 'app_perdant')]
    public function perdant(): Response
    {
        return $this->render('home/perdant.html.twig');
    }

    #[Route('/citation', name: 'app_citation')]
    public function citation(): Response
    {
        return $this->render('home/citation.html.twig');
    }

    #[Route('/bien-debuter', name: 'app_bien_debuter')]
    public function bienDebuter(): Response
    {
        return $this->render('home/bienDebuter.html.twig');
    }

    #[Route('/performance', name: 'app_performance')]
    public function performance(): Response
    {
        return $this->render('home/performance.html.twig');
    }

}

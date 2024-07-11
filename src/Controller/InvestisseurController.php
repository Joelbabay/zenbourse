<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class InvestisseurController extends AbstractController
{
    #[Route('/investisseur', name: 'app_investisseur')]
    public function index(): Response
    {
        return $this->render('investisseur/index.html.twig', [
        ]);
    }

    #[Route('/investisseur/presentation', name: 'app_investisseur_presentation')]
    public function investisseurPresentation(): Response
    {
        return $this->render('investisseur/presentation.html.twig', [
        ]);
    }
    #[Route('/investisseur/la-methode', name: 'app_investisseur_methode')]
    public function investisseurMehode(): Response
    {
        return $this->render('investisseur/methodes.html.twig', [
        ]);
    }
}

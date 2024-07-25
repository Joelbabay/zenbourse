<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class IntradayController extends AbstractController
{
    #[Route('/intraday', name: 'app_intraday')]
    public function index(): Response
    {
        return $this->render('intraday/index.html.twig', [
            'controller_name' => 'IntradayController',
        ]);
    }

    #[Route('/intraday/presentation', name: 'app_intraday_presentation')]
    public function app_intraday_presentation(): Response
    {
        return $this->render('intraday/intraday-presentation.html.twig', [
            'controller_name' => 'IntradayController',
        ]);
    }

    #[Route('/intraday/la-methode', name: 'app_intraday_methode')]
    public function app_intraday_methode(): Response
    {
        return $this->render('intraday/intraday-methode.html.twig', [

        ]);
    }

    #[Route('/intraday/bibliotheque', name: 'app_intraday_bibliotheque')]
    public function app_intraday_bibliotheque(): Response
    {
        return $this->render('intraday/intraday-bibliotheque.html.twig', [

        ]);
    }
}

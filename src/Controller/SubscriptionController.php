<?php

// src/Controller/SubscriptionController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\SubscriptionService;
use Symfony\Component\Security\Core\User\UserInterface;

class SubscriptionController extends AbstractController
{
    private $subscriptionService;

    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    #[Route('/subscribe/investisseur', name: 'subscribe_investisseur')]
    public function subscribeInvestisseur(UserInterface $user): Response
    {
        $this->subscriptionService->requestInvestisseurSubscription($user);

        return $this->redirectToRoute('app_home');
    }

    #[Route('/subscribe/intraday', name: 'subscribe_intraday')]
    public function subscribeIntraday(UserInterface $user): Response
    {
        try {
            $this->subscriptionService->subscribeToIntraday($user);
            return $this->redirectToRoute('intraday');
        } catch (\Exception $e) {
            $this->addFlash('error', $e->getMessage());
            return $this->redirectToRoute('app_investisseur');
        }
    }
}

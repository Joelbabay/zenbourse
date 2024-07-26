<?php
// src/Service/SubscriptionService.php
namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class SubscriptionService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function requestInvestisseurSubscription(User $user)
    {
        $user->setIsInvestisseurClient(true);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    /*public function approveInvestisseurSubscription(User $user)
    {
        if ($user->isInvestisseurPending()) {
            $user->setInvestisseurClient(true);
            $user->setIsInvestisseurPending(false);
            $user->setIsInvestisseurApproved(true);
            $this->entityManager->persist($user);
            $this->entityManager->flush();
        }
    }*/

    public function subscribeToIntraday(User $user)
    {
        if ($user->getIsInvestisseurClient()) {
            $user->setIsIntradayClient(true);
            $this->entityManager->persist($user);
            //$this->entityManager->flush();
        } else {
            throw new \Exception('Vous devez d\'abord être approuvé pour la méthode investisseur.');
        }
    }
}

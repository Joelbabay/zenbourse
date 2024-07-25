<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{
    #[Route('/user/{id}', name: 'app_user')]
    public function index(?User $user): Response
    {
        if ($user === null) {
            return $this->redirectToRoute('app_home');
        }
        return $this->render('user/index.html.twig', [
            'user'=> $user,
        ]);
    }
}

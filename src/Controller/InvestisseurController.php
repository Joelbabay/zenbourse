<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\InvestisseurSubscriptionType;
use App\Service\SubscriptionService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class InvestisseurController extends AbstractController
{
    private $entityManager;
    private $passwordHasher;
    private $subscriptionService;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher, SubscriptionService $subscriptionService)
    {
        $this->entityManager = $entityManager;
        $this->passwordHasher = $passwordHasher;
        $this->subscriptionService = $subscriptionService;
    }

    #[Route('/subscribe/investisseur', name: 'investisseur_subscription')]
    public function subscribe(Request $request): Response
    {
        $user = $this->getUser();

        if ($user && $user->getIsInvestisseurClient()) {
            $this->addFlash('info', 'Vous êtes déjà abonné à la méthode investisseur.');
            return $this->redirectToRoute('app_investisseur');
        }

        if ($user) {
            $form = $this->createForm(InvestisseurSubscriptionType::class, $user, [
                'existing_user' => true,
            ]);
        }
        else
        {
            $user = new User();
            $form = $this->createForm(InvestisseurSubscriptionType::class, $user, [
                'existing_user' => false,
            ]);
        }

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (!$user->getId()) {
                $user->setCreatedAt(new \DateTime());
                $user->setPassword($this->passwordHasher->hashPassword($user, 'zenbourse'));
                $this->entityManager->persist($user);
            }

            $this->entityManager->flush();

            //$this->subscriptionService->requestInvestisseurSubscription($user);

            $this->addFlash('success', 'Votre demande d\'adhésion a été soumise avec succès.');

            return $this->redirectToRoute('app_home');
        }

        return $this->render('home/achatInvestisseur.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/investisseur ', name: 'app_investisseur')]
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

    #[Route('/investisseur/la-methode/vagues-elliott', name: 'app_investisseur_methode_vagues_elliott')]
    public function app_investisseur_methode_vagues_elliott(): Response
    {
        return $this->render('investisseur/methodes-vagues-elliott.html.twig', [
        ]);
    }

    #[Route('/investisseur/la-methode/cycles-boursiers', name: 'app_investisseur_methode_cycles_boursiers')]
    public function app_investisseur_methode_cycles_boursiers(): Response
    {
        return $this->render('investisseur/methodes-cycles-boursiers.html.twig', [
        ]);
    }

    #[Route('/investisseur/la-methode/boites-bulles', name: 'app_investisseur_methode_boites_bulles')]
    public function app_investisseur_methode_boites_bulles(): Response
    {
        return $this->render('investisseur/methodes-boites-bulles.html.twig', [
        ]);
    }

    #[Route('/investisseur/la-methode/indicateurs', name: 'app_investisseur_methode_indicateurs')]
    public function app_investisseur_methode_indicateurs(): Response
    {
        return $this->render('investisseur/methodes-indicateurs.html.twig', [
        ]);
    }

    #[Route('/investisseur/bibliotheque', name: 'app_investisseur_bibliotheque')]
    public function investisseurBibliotheque(): Response
    {
        return $this->render('investisseur/bibliotheque.html.twig', [
        ]);
    }

    #[Route('/investisseur/bibliotheque/pics-de-volume', name: 'app_investisseur_bibliotheque_pics_volumes')]
    public function app_investisseur_bibliotheque_pics_volumes(): Response
    {
        return $this->render('investisseur/bibliothequePicVolume.html.twig', [
        ]);
    }
    #[Route('/investisseur/bibliotheque/ramassage', name: 'app_investisseur_bibliotheque_ramasssage')]
    public function app_investisseur_bibliotheque_ramasssage(): Response
    {
        return $this->render('investisseur/bibliotheque-ramassage.html.twig', [
        ]);
    }

    #[Route('/investisseur/bibliotheque/ramassage-pic', name: 'app_investisseur_bibliotheque_ramasssage_pic')]
    public function app_investisseur_bibliotheque_ramasssage_pic(): Response
    {
        return $this->render('investisseur/bibliotheque-ramassage-pic.html.twig', [
        ]);
    }

    #[Route('/investisseur/bibliotheque/pic-ramassage', name: 'app_investisseur_bibliotheque_pic_ramassage')]
    public function app_investisseur_bibliotheque_pic_ramassage(): Response
    {
        return $this->render('investisseur/bibliotheque-pic-ramassage.html.twig', [
        ]);
    }

    #[Route('/investisseur/bibliotheque/volumes-faibles', name: 'app_investisseur_bibliotheque_volumes_faibles')]
    public function app_investisseur_bibliotheque_volumes_faibles(): Response
    {
        return $this->render('investisseur/bibliotheque-volumes-faibles.html.twig', [
        ]);
    }

    #[Route('/investisseur/bibliotheque/introduction', name: 'app_investisseur_bibliotheque_introduction')]
    public function app_investisseur_bibliotheque_introduction(): Response
    {
        return $this->render('investisseur/bibliotheque-introduction.html.twig', [
        ]);
    }

    #[Route('/investisseur/outils', name: 'app_investisseur_outils')]
    public function app_investisseur_outils(): Response
    {
        return $this->render('investisseur/outils.html.twig', [
        ]);
    }

    #[Route('/investisseur/gestion', name: 'app_investisseur_gestion')]
    public function app_investisseur_gestion(): Response
    {
        return $this->render('investisseur/gestion.html.twig', [
        ]);
    }

    #[Route('/investisseur/introduction', name: 'app_investisseur_introduction')]
    public function app_investisseur_introduction(): Response
    {
        return $this->render('investisseur/introduction.html.twig', [
        ]);
    }
}

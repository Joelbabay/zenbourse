<?php

namespace App\Controller;

use App\Entity\AnonymousUser;
use App\Form\AnonymousUserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class DownloadController extends AbstractController
{
    private $file_directory;
    public function __construct(private EntityManagerInterface $entityManager, ParameterBagInterface $parameterBag)
    {
        $this->file_directory = $parameterBag->get('download_directory') . '/file.pdf';
    }

    #[Route('/download', name: 'download_page')]
    public function downloadPage(Request $request): Response
    {

        //dd($parameterBag->get('download_directory'));
        $anonymousUser = new AnonymousUser();
        $form = $this->createForm(AnonymousUserType::class, $anonymousUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($anonymousUser);
            $this->entityManager->flush();

            return $this->redirectToRoute('file_download');
        }
        return $this->render('home/download.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/file/download', name: 'file_download')]
    public function downloadFile(): Response
    {
        //$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $filePath = $this->file_directory;
        return $this->file($filePath);
    }
}

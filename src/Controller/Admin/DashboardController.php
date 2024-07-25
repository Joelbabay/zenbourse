<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Contact;
use App\Entity\Menu;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(ArticleCrudController::class)->generateUrl());

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Zenbourse')

            
            ;
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::subMenu('Articles', 'fas fa-newspaper')->setSubItems(
            [
                MenuItem::linkToCrud('Tous les articles', 'fas fa-newspaper', Article::class),
                MenuItem::linkToCrud('Ajouter', 'fas fa-plus', Article::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('Catégories', 'fas fa-list', Category::class),

            ]
        );

        yield MenuItem::subMenu('Compte', 'fas fa-user')->setSubItems(
            [
                MenuItem::linkToCrud('Utilisateurs', 'fas fa-user-friends', User::class),
                MenuItem::linkToCrud('Ajouter', 'fas fa-plus', User::class)->setAction(Crud::PAGE_NEW),
            ]
        )
        ;

        yield MenuItem::subMenu('Menus', 'fas fa-list')->setSubItems([
            MenuItem::linkToCrud('Pages', 'fas fa-file', Menu::class)
                ->setQueryParameter('submenuIndex', 0),
            MenuItem::linkToCrud('Articles', 'fas fa-newspaper', Menu::class)
                ->setQueryParameter('submenuIndex', 1),
            MenuItem::linkToCrud('Liens personnalisés', 'fas fa-link', Menu::class)
                ->setQueryParameter('submenuIndex', 2),
            MenuItem::linkToCrud('Catégories', 'fab fa-delicious', Menu::class)
                ->setQueryParameter('submenuIndex', 3),
        ]);

        yield MenuItem::linkToCrud('Contact', 'fas fa-message', Contact::class);
    }
}

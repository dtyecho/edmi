<?php

namespace App\Controller\Admin;

use App\Entity\EtablissementDoctoral;
use App\Entity\FormationDoctorale;
use App\Entity\Professeur;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{

    public function __construct(private AdminUrlGenerator $adminUrlGenerator){
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        //On va générer un url vers les professeurs
        //cela va générer la route corresponsdante à l'affichage des produits

        $url = $this->adminUrlGenerator->setController(ProfesseurCrudController::class)->generateUrl();

        return $this->redirect($url);

        //return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Edmiapp');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::section('Professeurs');
        yield MenuItem::subMenu('Actions', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Create Professeur', 'fas fa-plus', Professeur::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Professeur', 'fas fa-eye', Professeur::class)
        ]);

        yield MenuItem::section('Etablissements doctorales');
        yield MenuItem::subMenu('Actions', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Create Etablissement doctorale', 'fas fa-plus', EtablissementDoctoral::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Etablissement doctorale', 'fas fa-eye', EtablissementDoctoral::class)
        ]);

        yield MenuItem::section('Formations doctorales');
        yield MenuItem::subMenu('Actions', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Create Formation doctorale', 'fas fa-plus', FormationDoctorale::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Formations doctorales', 'fas fa-eye', FormationDoctorale::class)
        ]);


        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}

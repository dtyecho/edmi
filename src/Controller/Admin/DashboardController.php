<?php

namespace App\Controller\Admin;

use App\Entity\Dossier;
use App\Entity\EtablissementDoctoral;
use App\Entity\Etudiant;
use App\Entity\FormationDoctorale;
use App\Entity\Laboratoire;
use App\Entity\Professeur;
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

    public function __construct(private AdminUrlGenerator $adminUrlGenerator){
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        //On va générer un url vers les professeurs
        //cela va générer la route corresponsdante à l'affichage des produits

        $url = $this->adminUrlGenerator->setController(FormationDoctoraleCrudController::class)->generateUrl();

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
            MenuItem::linkToCrud('Créer Professeur', 'fas fa-plus', Professeur::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Lister les Professeurs', 'fas fa-eye', Professeur::class)
        ]);

        yield MenuItem::section('Etudiant');
        yield MenuItem::subMenu('Actions', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Create Etudiant', 'fas fa-plus', Etudiant::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Lister les Etudiants', 'fas fa-eye', Etudiant::class)
        ]);

        yield MenuItem::section('Dossiers');
        yield MenuItem::subMenu('Actions', 'fas fas-bars')->setSubItems([
            MenuItem::linkToCrud('Lister les dossiers', 'fas fa-eye', Dossier::class)
        ]);




        yield MenuItem::section('Laboratoire');
        yield MenuItem::subMenu('Actions', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Créer laboratoire', 'fas fa-plus', Laboratoire::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Lister les Laboratoires', 'fas fa-eye', Laboratoire::class)
        ]);

        yield MenuItem::section('Etablissements doctorales');
        yield MenuItem::subMenu('Actions', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Créer un Etablissement doctorale', 'fas fa-plus', EtablissementDoctoral::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Lister les Etablissement doctorale', 'fas fa-eye', EtablissementDoctoral::class)
        ]);

        yield MenuItem::section('Formations doctorales');
        yield MenuItem::subMenu('Actions', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Créer Formation doctorale', 'fas fa-plus', FormationDoctorale::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Lister les Formations doctorales', 'fas fa-eye', FormationDoctorale::class)
        ]);



        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}

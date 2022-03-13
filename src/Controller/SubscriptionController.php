<?php

namespace App\Controller;

use App\Entity\Dossier;
use App\Form\DossierType;
use App\Repository\DossierRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SubscriptionController extends AbstractController
{

    //COnstructeur pour la gestion
    public function __construct(DossierRepository $repo, EntityManagerInterface $em)
    {
        $this->repo =$repo;
        $this->em = $em;
    }

    #[Route('/subscription', name: 'app_subscription')]
    public function index(Request $request): Response
    {

        //déclare un nouveau dossier
        $dossier = new Dossier();
        //formulaire
        $form = $this->createForm(DossierType::class, $dossier);
        //gestion du formaulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $this->em->persist($dossier);
            $this->em->flush();

            //redirection dans home
            return $this->redirectToRoute('app_home');
        }


        return $this->render('subscription/index.html.twig', [
            'controller_name' => 'SubscriptionController',
            'form' => $form->createView()
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Vol;
use App\Form\VolTypeForm;
use App\Repository\VolRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class VolController extends AbstractController
{
    #[Route('/vol', name: 'app_vol')]
    public function index(): Response
    {
        return $this->render('vol/index.html.twig', [
            'controller_name' => 'VolController',
            'message' => 'Bienvenue sur la page vol'
        ]);
    }

    #[Route('/vol/{id<[0-9]+>}', name: 'vol_detail')]
    public function detail(int $id): Response
    {
        return new Response("Détails du vol numéro : $id");
    }

    #[Route('/vol/ajout', name: 'ajouter_vol')]
    public function ajouterVol(\Symfony\Component\HttpFoundation\Request $request, EntityManagerInterface $entityManager): Response
    {
        $vol = new Vol();
        $form = $this->createForm(VolTypeForm::class, $vol);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($vol);
            $entityManager->flush();

            return $this->redirectToRoute('liste_vols');
        }

        return $this->render('vol/ajout.html.twig', [
            'form' => $form->createView(),
        ]);

    }

    #[Route('/vols', name: 'liste_vols')]
    public function listeVols(VolRepository $volRepository): Response
    {
        $vols = $volRepository->findAll();
        return $this->render('vol/liste.html.twig', ['vols' => $vols]);
    }


}

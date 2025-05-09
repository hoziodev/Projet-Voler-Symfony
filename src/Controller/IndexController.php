<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\ReservationForm;
use App\Repository\ReservationRepository;
use App\Repository\VolRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
        return $this->render('index/index.html.twig');
    }

    #[Route('/vol', name: 'app_vols_index', methods: ['GET'])]
    public function vols(VolRepository $volRepository, ReservationRepository $reservationRepository): Response
    {
        return $this->render('index/vol.html.twig', [
            'vols' => $volRepository->findAll(),
        ]);
    }

    #[Route('/reserver/{id}', name: 'app_reserver', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, int $id, ReservationRepository $reservationRepository, VolRepository $volRepository): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_index');
        }
        $reservation = new Reservation();
        $vol = $volRepository->find($id);
        $reservation->setRefVol($vol);
        $reservation->setRefUser($this->getUser());
        $reservationRepository->ajustementPrixBillet($reservation, $vol);
        $entityManager->persist($reservation);
        $entityManager->flush();

        return $this->redirectToRoute('app_index');
    }
}

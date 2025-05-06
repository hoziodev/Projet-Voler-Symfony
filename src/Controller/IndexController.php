<?php

namespace App\Controller;

use App\Repository\VolRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(VolRepository $volRepository): Response
    {
        return $this->render('index/index.html.twig',[
        'vols' => $volRepository->findAll(),
        ]);
    }
}

<?php

namespace App\Controller;

use App\DataFixtures;
use App\Entity\Peinture;
use App\Repository\PeintureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(PeintureRepository $peintureRepository): Response
    {
        $peints = $peintureRepository->findAll();
        
        return $this->render('home/index.html.twig', [
            'peints' => $peints,
        ]);
    }
    /**
     * @Route("/{nom}", name="show", methods={"GET"})
     * 
     */
    public function show(Peinture $peinture, $nom): Response
    {

        return $this->render('home/peint_show.html.twig', [
            'peint' => $peinture,
        ]);
    }
}

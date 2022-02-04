<?php

namespace App\Controller;

use App\Entity\Peinture;
use App\Form\PeintureType;
use App\Repository\PeintureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/peinture")
 */
class PeintureController extends AbstractController
{
    /**
     * @Route("/", name="peinture_index", methods={"GET"})
     */
    public function index(PeintureRepository $peintureRepository): Response
    {
        return $this->render('peinture/index.html.twig', [
            'peintures' => $peintureRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="peinture_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $peinture = new Peinture();
        $form = $this->createForm(PeintureType::class, $peinture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($peinture);
            $entityManager->flush();

            return $this->redirectToRoute('peinture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('peinture/new.html.twig', [
            'peinture' => $peinture,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="peinture_show", methods={"GET"})
     */
    public function show(Peinture $peinture): Response
    {
        return $this->render('peinture/show.html.twig', [
            'peinture' => $peinture,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="peinture_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Peinture $peinture, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PeintureType::class, $peinture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('peinture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('peinture/edit.html.twig', [
            'peinture' => $peinture,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="peinture_delete", methods={"POST"})
     */
    public function delete(Request $request, Peinture $peinture, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$peinture->getId(), $request->request->get('_token'))) {
            $entityManager->remove($peinture);
            $entityManager->flush();
        }

        return $this->redirectToRoute('peinture_index', [], Response::HTTP_SEE_OTHER);
    }
}

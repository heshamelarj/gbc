<?php

namespace App\Controller;

use App\Entity\LigneFacture;
use App\Form\LignefactureType;
use App\Repository\LignefactureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/lignefacture")
 */
class LignefactureController extends AbstractController
{
    /**
     * @Route("/", name="lignefacture_index", methods={"GET"})
     */
    public function index(LignefactureRepository $lignefactureRepository): Response
    {
        return $this->render('lignefacture/index.html.twig', [
            'lignefactures' => $lignefactureRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="lignefacture_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $lignefacture = new LigneFacture();
        $form = $this->createForm(LignefactureType::class, $lignefacture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($lignefacture);
            $entityManager->flush();

            return $this->redirectToRoute('lignefacture_index');
        }

        return $this->render('lignefacture/new.html.twig', [
            'lignefacture' => $lignefacture,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="lignefacture_show", methods={"GET"})
     */
    public function show(LigneFacture $lignefacture): Response
    {
        return $this->render('lignefacture/show.html.twig', [
            'lignefacture' => $lignefacture,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="lignefacture_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, LigneFacture $lignefacture): Response
    {
        $form = $this->createForm(LignefactureType::class, $lignefacture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('lignefacture_index', [
                'id' => $lignefacture->getId(),
            ]);
        }

        return $this->render('lignefacture/edit.html.twig', [
            'lignefacture' => $lignefacture,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="lignefacture_delete", methods={"DELETE"})
     */
    public function delete(Request $request, LigneFacture $lignefacture): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lignefacture->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($lignefacture);
            $entityManager->flush();
        }

        return $this->redirectToRoute('lignefacture_index');
    }
}

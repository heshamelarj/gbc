<?php

namespace App\Controller;

use App\Entity\MessageTache;
use App\Form\MessagetacheType;
use App\Repository\MessagetacheRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/messagetache")
 */
class MessagetacheController extends AbstractController
{
    /**
     * @Route("/", name="messagetache_index", methods={"GET"})
     */
    public function index(MessagetacheRepository $messagetacheRepository): Response
    {
        return $this->render('messagetache/index.html.twig', [
            'messagetaches' => $messagetacheRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="messagetache_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $messagetache = new MessageTache();
        $form = $this->createForm(MessagetacheType::class, $messagetache);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($messagetache);
            $entityManager->flush();

            return $this->redirectToRoute('messagetache_index');
        }

        return $this->render('messagetache/new.html.twig', [
            'messagetache' => $messagetache,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="messagetache_show", methods={"GET"})
     */
    public function show(MessageTache $messagetache): Response
    {
        return $this->render('messagetache/show.html.twig', [
            'messagetache' => $messagetache,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="messagetache_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, MessageTache $messagetache): Response
    {
        $form = $this->createForm(MessagetacheType::class, $messagetache);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('messagetache_index', [
                'id' => $messagetache->getId(),
            ]);
        }

        return $this->render('messagetache/edit.html.twig', [
            'messagetache' => $messagetache,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="messagetache_delete", methods={"DELETE"})
     */
    public function delete(Request $request, MessageTache $messagetache): Response
    {
        if ($this->isCsrfTokenValid('delete'.$messagetache->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($messagetache);
            $entityManager->flush();
        }

        return $this->redirectToRoute('messagetache_index');
    }
}

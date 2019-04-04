<?php

namespace App\Controller;

use App\Entity\Caisse;
use App\Entity\CaisseLog;
use App\Form\CaisseType;
use App\Repository\CaisseRepository;
use App\Repository\CaisseLogRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/caisse")
 */
class CaisseController extends AbstractController
{
    /**
     * @Route("/dash", name="caisse")
     */
    public function index(CaisseRepository $caisseRepository, CaisseLogRepository $caisseLogRepository): Response
    {

        $caisse = $this->getDoctrine()
        ->getRepository(CaisseLog::class)
        ->findAll();
        
        
        


        $firstDateTime = new \DateTime();
        $lastDateTime = $firstDateTime->modify('+ 7 day');
        $lastDateTime2 =$firstDateTime->modify('+14 day');
        $lastDateTime3 =$firstDateTime->modify('+21 day');
        $lastDateTime4 =$firstDateTime->modify('+28 day');


        $sum1 = $caisseLogRepository->getlogbydate($firstDateTime,$lastDateTime);
        $sum2 = $caisseLogRepository->getlogbydate($firstDateTime,$lastDateTime2);
        $sum3 = $caisseLogRepository->getlogbydate($firstDateTime,$lastDateTime3);
        $sum4 = $caisseLogRepository->getlogbydate($firstDateTime,$lastDateTime4);

        

    dump($sum1);die();


        return $this->render('caisse/index.html.twig', [
            'caisse' => $caisse,
            
        ]);
    }

    /**
     * @Route("/new", name="caisse_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $caisse = new Caisse();
        $form = $this->createForm(CaisseType::class, $caisse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($caisse);
            $entityManager->flush();

            return $this->redirectToRoute('caisse_index');
        }

        return $this->render('caisse/new.html.twig', [
            'caisse' => $caisse,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="caisse_show", methods={"GET"})
     */
    public function show(Caisse $caisse): Response
    {
        return $this->render('caisse/show.html.twig', [
            'caisse' => $caisse,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="caisse_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Caisse $caisse): Response
    {
        $form = $this->createForm(CaisseType::class, $caisse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('caisse_index', [
                'id' => $caisse->getId(),
            ]);
        }

        return $this->render('caisse/edit.html.twig', [
            'caisse' => $caisse,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="caisse_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Caisse $caisse): Response
    {
        if ($this->isCsrfTokenValid('delete'.$caisse->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($caisse);
            $entityManager->flush();
        }

        return $this->redirectToRoute('caisse');
    }
}

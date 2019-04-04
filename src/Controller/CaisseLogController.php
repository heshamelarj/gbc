<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CaisseLogController extends AbstractController
{
    /**
     * @Route("/log", name="caisse_log")
     */
    public function index()
    {
        return $this->render('caisse_log/index.html.twig', [
            'controller_name' => 'CaisseLogController',
        ]);
    }
}

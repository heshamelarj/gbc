<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\ServiceDataCHarts;

/**
 * @Route("/")
 */
class TestController extends AbstractController
{

    /**
     * @Route("/", name="caisse_index", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->render('base.html.twig');
    }



    
}

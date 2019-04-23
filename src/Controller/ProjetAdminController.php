<?php
/**
 * Created by PhpStorm.
 * User: heshamelarj
 * Date: 4/23/19
 * Time: 11:04 AM
 */

namespace App\Controller;


use App\Repository\ProjetRepository;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class ProjetAdminController extends CRUDController
{
    /**
     * @var ProjetRepository
     */
    private $projetRepository;

    public function __construct(ProjetRepository $projetRepository)
    {

        $this->projetRepository = $projetRepository;
    }

    public function projetsAsJsonAction(SerializerInterface $serializer): Response
    {
        $projets = $this->projetRepository->findAll();
        $jsonProjets = $serializer->serialize($projets, 'json', [
            'circular_reference_handler' => function ($object) {
                return $object->getId();
            }
        ]);
       return  new Response($jsonProjets, 200, ['Content-Type' => 'application/json']);


    }



}
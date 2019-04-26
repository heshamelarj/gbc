<?php
/**
 * Created by PhpStorm.
 * User: heshamelarj
 * Date: 4/26/19
 * Time: 12:57 PM
 */

namespace App\Controller;


use App\Repository\TacheRepository;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class AgendaAdminController extends CRUDController
{
    public function listAction()
    {
        return $this->render('admin/agenda.html.twig');
    }
    public function fetchOneDayTachesJsonAction(SerializerInterface $serializer, TacheRepository $tacheRepository)
    {
        $taches = $tacheRepository->findByOneDayTimeLine();
        $jsonTaches = $serializer->serialize($taches, 'json', [
            'circular_reference_handler' => function ($object) {
                return $object->getId();
            }
        ]);
        return  new Response($jsonTaches, 200, ['Content-Type' => 'application/json']);
    }
}
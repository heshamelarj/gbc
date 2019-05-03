<?php
/**
 * Created by PhpStorm.
 * User: heshamelarj
 * Date: 4/26/19
 * Time: 12:57 PM
 */

namespace App\Controller;


use App\Entity\Tache;
use App\Repository\TacheRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\Request;
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
        $taches = $tacheRepository->findAllWithIdStartEndProperties();
        $jsonTaches = $serializer->serialize($taches, 'json', [
            'circular_reference_handler' => function ($object) {
                return $object->getId();
            }
        ]);
        return  new Response($jsonTaches, 200, ['Content-Type' => 'application/json']);
    }
    public function editTacheOnAgendaAction(Request $request,  TacheRepository $tacheRepository, EntityManagerInterface $entityManager)
    {
        $parametersAsArray = [];
        if($request->getContent()) $parametersAsArray = json_decode($request->getContent());

        if($parametersAsArray){

            $tacheId = ((int)$parametersAsArray->id);
            $tacheToBeUpdated = $tacheRepository->findOneById($tacheId);
            $tacheToBeUpdated->setDatedebut(new \DateTime($parametersAsArray->start));
            $tacheToBeUpdated->setDatefin(new \DateTime($parametersAsArray->end));
            $entityManager->persist($tacheToBeUpdated);
            $entityManager->flush();

            $response = new Response('Tache Identifies by ID: '.$parametersAsArray->id.' Date Updated Successfully ', Response::HTTP_OK);
            return $response;


        }




    }
}
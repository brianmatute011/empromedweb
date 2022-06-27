<?php

namespace App\Controller;

use App\Entity\Laboratory;
use App\Entity\Workers;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use phpDocumentor\Reflection\Types\String_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TWorkerController extends AbstractController
{

    #[Route('main/tworker', name: 'app_t_worker')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $worker = $doctrine->getRepository(Workers::class)->findAll();
        $result = $doctrine->getRepository(Workers::class)->findBySalario();
        $doctrine->getManagers();
        return $this->render('t_worker/index.html.twig', [
            'controller_name' => 'TWorkerController',
            'workers' => $worker,
            'salario' => $result,
        ]);
    }

    #[Route('/saveworker', name: 'app_saveworker')]
    public function saveForm(Request $request, ManagerRegistry $doctrine, EntityManagerInterface $em) :Response
    {
        $GetArrayForm = $request->request;
        if($GetArrayForm->count() == 1) { //From form delete worker
            $deleteObjectWorker = new Workers();
            $deleteObjectWorker = $doctrine->getRepository(Workers::class)->find($GetArrayForm->getInt('id-worker'));
            if ($deleteObjectWorker != null){
                $em->remove($deleteObjectWorker);
                $em->flush();
            }
        }
        else { //From form insert worker
            $worker  = new Workers();
            $worker->setId($GetArrayForm->getInt('id-worker'));
            $worker->setName((string)$GetArrayForm->get('nam'));
            $worker->setAge($GetArrayForm->getInt('age'));
            $worker->setSex((string)$GetArrayForm->get('sex'));
            $worker->setPosition((string)$GetArrayForm->get('position'));
            $worker->setYearExperiences($GetArrayForm->getInt('age-exp'));
            $worker->setSalario((float)$GetArrayForm->get('salary'));
            $tempLaboratory = $doctrine->getRepository(Laboratory::class)->find($GetArrayForm->getInt('id-lab'));
            $worker->setLWID($tempLaboratory);
            $doctrine->getManager()->persist($worker);
            $doctrine->getManager()->flush();
        }

        return $this->redirectToRoute('app_t_worker', ['var' => 1]);
    }

}

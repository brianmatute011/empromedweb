<?php

namespace App\Controller;

use App\Entity\Evaluation;
use App\Entity\Production;
use App\Entity\Workers;
use Doctrine\Persistence\ManagerRegistry;
use phpDocumentor\Reflection\Types\This;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TEvaluationController extends AbstractController
{
    #[Route('main/tevaluation', name: 'app_t_evaluation')]
    public function index(ManagerRegistry $doctrine): Response
    {   $evaluation = $doctrine->getRepository(Evaluation::class)->findAll();

        return $this->render('t_evaluation/index.html.twig', [
            'controller_name' => 'TEvaluationController',
            'evaluations' => $evaluation
        ]);
    }


    #[Route('main/tevaluation/saveformeval', name: 'app_saveeval')]
    public function saveEval(Request $request, ManagerRegistry $doctrine) : Response{
        $GetArrayForm = $request->request;
        $eval = new Evaluation();
        $eval->setPEID($doctrine->getRepository(Production::class)
             ->find($GetArrayForm->get('id-production')));
        $eval->setTEID($doctrine->getRepository(Workers::class)
             ->find($GetArrayForm->get('id-worker')));
        $dt = new \DateTime($GetArrayForm->get('date'));
        $eval->setEvaluationDate($dt);
        $eval->setComment($GetArrayForm->get('comment'));
        $eval->setResult($GetArrayForm->get('result'));

        $doctrine->getManager()->persist($eval);
        $doctrine->getManager()->flush();


        return $this->redirectToRoute('app_t_evaluation');
    }
}

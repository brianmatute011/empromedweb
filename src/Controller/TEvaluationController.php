<?php

namespace App\Controller;

use App\Entity\Evaluation;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TEvaluationController extends AbstractController
{
    #[Route('/tevaluation', name: 'app_t_evaluation')]
    public function index(ManagerRegistry $doctrine): Response
    {   $evaluation = $doctrine->getRepository(Evaluation::class)->findAll();

        return $this->render('t_evaluation/index.html.twig', [
            'controller_name' => 'TEvaluationController',
            'evaluations' => $evaluation
        ]);
    }
}

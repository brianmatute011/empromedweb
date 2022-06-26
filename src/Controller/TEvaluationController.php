<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TEvaluationController extends AbstractController
{
    #[Route('/t/evaluation', name: 'app_t_evaluation')]
    public function index(): Response
    {
        return $this->render('t_evaluation/index.html.twig', [
            'controller_name' => 'TEvaluationController',
        ]);
    }
}

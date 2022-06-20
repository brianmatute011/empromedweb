<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TProductionController extends AbstractController
{
    #[Route('/tproduction', name: 'app_t_production')]
    public function index(): Response
    {
        return $this->render('t_production/index.html.twig', [
            'controller_name' => 'TProductionController',
        ]);
    }
}

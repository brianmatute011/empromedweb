<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TWorkerController extends AbstractController
{
    #[Route('/tworker', name: 'app_t_worker')]
    public function index(): Response
    {
        return $this->render('t_worker/index.html.twig', [
            'controller_name' => 'TWorkerController',
        ]);
    }
}

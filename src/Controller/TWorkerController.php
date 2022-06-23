<?php

namespace App\Controller;

use App\Entity\Workers;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TWorkerController extends AbstractController
{
    #[Route('/tworker', name: 'app_t_worker')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $worker = $doctrine->getRepository(Workers::class)->findAll();
        $result = $doctrine->getRepository(Workers::class)->findBySalario();

        $doctrine->getManagers();
        return $this->render('t_worker/index.html.twig', [
            'controller_name' => 'TWorkerController',
            'workers' => $worker,
            'salario' => $result
        ]);
    }
}

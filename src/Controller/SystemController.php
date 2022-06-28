<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SystemController extends AbstractController
{
    #[Route('/main/system', name: 'app_system')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $getArrayUsers = $doctrine->getRepository(User::class)->findAll();


        return $this->render('system/index.html.twig', [
            'controller_name' => 'SystemController',
            'users' => $getArrayUsers
        ]);
    }
}

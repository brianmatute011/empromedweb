<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TChemicalComponentsController extends AbstractController
{
    #[Route('/tchemicalcomponents', name: 'app_t_chemical_components')]
    public function index(): Response
    {
        return $this->render('t_chemical_components/index.html.twig', [
            'controller_name' => 'TChemicalComponentsController',
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Production;
use App\Entity\Products;
use App\Entity\Workers;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TProductionController extends AbstractController
{
    #[Route('main/tproduction', name: 'app_t_production')]
    public function index( ManagerRegistry $doctrine): Response
    {
        $production = $doctrine->getRepository(Production::class)->findAll();
        $a = "ROLE_USER";

        return $this->render('t_production/index.html.twig', [
            'productions' => $production,
            'roleuser' => $a,
        ]);
    }
    #[Route('/saveproduction', name: 'app_saveproduction')]
    public function saveform(Request $request, ManagerRegistry $doctrine): Response
    {
          $fecha =  $request->request->get('fecha');
          $cantidad =   $request->request->getInt('cantidad');
          $idWorker =  $request->request->getInt('id-worker');
          $idProducto =  $request->request->getInt('id-producto');

          $worker = $doctrine->getRepository(Workers::class)->find($idWorker);
          $product = $doctrine->getRepository(Products::class)->find($idProducto);
          $production = new Production();
          $production->setProductionDate(new \DateTime($fecha));
          $production->setCant($cantidad);
          $production->setIDW($worker);
          $production->setIDP($product);
          $doctrine->getManager()->persist($production);
          $doctrine->getManager()->flush();

         return $this->redirectToRoute('app_t_production');
    }


}

<?php

namespace App\Controller;

use App\Entity\Laboratory;
use App\Entity\Products;
use App\Entity\Workers;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TProductController extends AbstractController
{
    #[Route('main/tproduct', name: 'app_t_product')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $products = $doctrine->getRepository(Products::class)->findAll();

        return $this->render('t_product/index.html.twig', [
            'controller_name' => 'TProductController',
            'products' => $products
        ]);
    }

    #[Route('/saveproduct', name: 'app_saveproduct')]
    public function saveForm(Request $request, ManagerRegistry $doctrine, EntityManagerInterface $em) :Response
    {
        $GetArrayForm = $request->request;
        if($GetArrayForm->count() == 1) { //From form delete products
            $deleteObjectProduct = $doctrine->getRepository(Products::class)->find($GetArrayForm->getInt('id-product'));
            if ($deleteObjectProduct != null){
                $em->remove($deleteObjectProduct);
                $em->flush();
            }
        }
        else { //From form insert products
            $product = new Products();
            $product->setName((string)$GetArrayForm->get('nam'));
            $product->setType((string)$GetArrayForm->get('type'));
            $product->setTotal((int)$GetArrayForm->get('total'));
            $tempLab = $doctrine->getRepository(Laboratory::class)->find($GetArrayForm->get('id-lab'));
            $product->setLaboratoryID($tempLab);
            $doctrine->getManager()->persist($product);
            $doctrine->getManager()->flush();
        }

        return $this->redirectToRoute('app_t_product');
    }
}

<?php

namespace App\Controller;

use App\Entity\ChemicalsComponets;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TChemicalComponentsController extends AbstractController
{
    #[Route('main/tchemicalcomponents', name: 'app_t_chemical_components')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $chemicalC = $doctrine->getRepository(ChemicalsComponets::class)->findAll();
        return $this->render('t_chemical_components/index.html.twig', [
            'controller_name' => 'TChemicalComponentsController',
            'chemicalC' => $chemicalC
        ]);
    }

    #[Route('/savechemical', name: 'app_savechemical')]
    public function saveform(Request $request, ManagerRegistry $doctrine, EntityManagerInterface $em): Response
    {
        $GetArrayForm = $request->request;
        if($GetArrayForm->count() == 1) { //From form delete component
            $deleteObjectProduct = $doctrine->getRepository(ChemicalsComponets::class)->find($GetArrayForm->getInt('id-component'));
            if ($deleteObjectProduct != null){
                $em->remove($deleteObjectProduct);
                $em->flush();
            }
        }
        else { //From form insert component
            $component = new ChemicalsComponets();
            $component->setName((string)$GetArrayForm->get('nam'));
            $component->setPh((string)$GetArrayForm->get('ph'));
            $doctrine->getManager()->persist($component);
            $doctrine->getManager()->flush();
        }

        return $this->redirectToRoute('app_t_chemical_components');
    }
}

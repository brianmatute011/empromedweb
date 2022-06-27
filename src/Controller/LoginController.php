<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function index(AuthenticationUtils $authenticationUtils, Request $request, UserPasswordHasherInterface $passwordHasher, ManagerRegistry $doctrine,  EntityManagerInterface $em): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        $GetArrayForm = $request->request;
        $plaintextPassword = (string)$GetArrayForm->get('_password');
        $email =  (string)$GetArrayForm->get('_username');
        $getUserFromEmail = $doctrine->getRepository(User::class)->findByEmail($email, $em);
        if(count($getUserFromEmail) != 0){
            if (!$passwordHasher->isPasswordValid($getUserFromEmail[0], $plaintextPassword)){
                return $this->redirectToRoute('app_login');
            }
            else return $this->redirectToRoute('app_dash_board');
        }

        return $this->render('login/index.html.twig', [
            'controller_name' => 'LoginController',
            'last_username'   => $lastUsername,
            'error'           => $error,
        ]);
    }
}

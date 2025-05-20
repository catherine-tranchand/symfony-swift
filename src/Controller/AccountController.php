<?php

namespace App\Controller;

use App\Form\PasswordUserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;

final class AccountController extends AbstractController
{
    #[Route('/account', name: 'app_account')]
    public function index(): Response
    {
        return $this->render('account/index.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }
    #[Route('/account/modifier-mot-de-passe', name: 'app_account_modify_pwd')]
    public function password(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager ): Response
    { 
        
        
        $user = $this->getUser(); // Get the current user
        
        $form = $this->createForm(PasswordUserType::class, $user, [
            'passwordHasher' => $passwordHasher,
            'current_user' => $user,
            
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){

            $this->addFlash('success', 'Votre mot de passe a été modifié avec succès !'); //NOTIFICATION
            $entityManager->flush();
           
      

        }
        return $this->render('account/password.html.twig', [
           'modifyPwd' => $form->createView(),  
        ]);
    }
}

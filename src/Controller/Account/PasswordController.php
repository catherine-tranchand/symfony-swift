<?php

namespace App\Controller\Account;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Form\PasswordUserType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


final class PasswordController extends AbstractController
{
    private $entityManager;  

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/compte/modifier-mot-de-passe', name: 'app_account_modify_pwd')]
    public function index(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {  
        
        
        $user = $this->getUser(); // Get the current user
        
        $form = $this->createForm(PasswordUserType::class, $user, [
            'passwordHasher' => $passwordHasher,
            'current_user' => $user,
            
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){

            $this->addFlash('success', 'Votre mot de passe a été modifié avec succès !'); //NOTIFICATION
            $this->entityManager->flush();
           
      

        }
        return $this->render('account/password/index.html.twig', [
           'modifyPwd' => $form->createView(),  
        ]);
    }
}
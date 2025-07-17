<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\RegisterUserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;

final class RegisterController extends AbstractController
{
    #[Route('/register', name: 'app_register')]

    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User();  // Instanciation de l'objet User
        $form = $this->createForm(RegisterUserType::class, $user); // Création du formulaire
        $form->handleRequest($request); // Récupération des données du formulaire

        if ($form->isSubmitted() && $form->isValid()) {
      
           $entityManager->persist($user ); // pour figer les données 
           $entityManager->flush(); // pour envoyer les données en BDD
             
           $this->addFlash('success', 'Votre compte a été créé avec succès !'); //NOTIFICATION 
              return $this->redirectToRoute('app_login'); // Redirection vers la page de login

        }
        
        return $this->render('register/index.html.twig', parameters: [
            'registerForm' => $form->createView(),
        ]);
    }
}

// use -> j'appele le repertoire
// namespace -> je defénis un repertoire 
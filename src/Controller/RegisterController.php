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
        $user = new User(); 
        $form = $this->createForm(RegisterUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
          
           $entityManager->persist($user ); // 
           $entityManager->flush();

            // $user = $form->getData();
            // $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->persist($user);
            // $entityManager->flush();

            // return $this->redirectToRoute('app_home');
        }
        
        return $this->render('register/index.html.twig', [
            'registerForm' => $form->createView(),
        ]);
    }
}

// use -> j'appele le repertoire
// namespace -> je defénis un repertoire 
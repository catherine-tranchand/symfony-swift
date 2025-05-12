<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

final class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        $error= $authenticationUtils->getLastAuthenticationError(); // Gerer l'erreur d'authentification
        $lastUsername = $authenticationUtils->getLastUsername(); // Dernier username (email) utilisé
        return $this->render('login/index.html.twig', [
            'error' => $error,
            'last_username' => $lastUsername,
        ]);
    }

    #[Route('/logout', name: 'app_logout', methods: ['GET'])]
    public function logout(): never
    {
        // Symfony gère la déconnexion automatiquement
        // Vous pouvez rediriger l'utilisateur vers une autre page si nécessaire
       throw new \Exception('Logout');
    }
    
}

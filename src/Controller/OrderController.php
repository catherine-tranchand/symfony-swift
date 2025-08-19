<?php

namespace App\Controller;

use App\Form\OrderType;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


final class OrderController extends AbstractController
{
    /*
     * the first step of purchase funnel - 1ere etape du tunnel d'achat
     * -> delivery adresse + carrier choice   -l'adresse du livraison et choix du trasporteure  
     * 
    */

    #[Route('/commande/livraison', name: 'app_order')]
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        /** @var User $user */

        $user = $this->getUser();

        $addresses = $user?->getAddresses() ?? [];

        if(count($addresses) === 0 ){

            return $this->redirectToRoute('app_account_address_form');
        }

        $form = $this->createForm(OrderType::class, null, [
            'addresses' => $addresses
            
        ]); // pour reccupere le formulaire 

        return $this->render('order/index.html.twig', [
            'deliveryForm' => $form->createView(),
        ]);
    }
}

<?php

namespace App\Controller\Account;

use App\Classe\Cart;
use App\Entity\Address;
use App\Form\AddressUserType;
use App\Repository\AddressRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


final class AddressController extends AbstractController
{
    private $entityManager;  

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

        #[Route('/compte/adresses', name: 'app_account_addresses')]
    public function index(): Response
    {
        return $this->render('account/address/index.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }

  #[Route('/compte/adresses/delete/{id}', name: 'app_account_address_delete')]
   public function addressDelete($id, AddressRepository $addressRepository): Response
{
    $address = $addressRepository->findOneById($id);

    if (!$address || $address->getRelatedUser() !== $this->getUser()) {
       return $this->redirectToRoute('app_account_adresses');
    }

    $this->entityManager->remove($address);
    $this->entityManager->flush();

    $this->addFlash('success', 'Votre adresse a été supprimée !');

    return $this->redirectToRoute('app_account_addresses');
   }

    #[Route('/compte/adresse/ajouter/{id?}', name: 'app_account_address_form')] //{$id?} id par defaut est null, c'est un parametre optionel
    public function addressForm(Request $request, $id,  AddressRepository $addressRepository, Cart $cart): Response
    {
        if ($id) {
            $address = $addressRepository->findOneById($id);
            if(!$address OR $address->getRelatedUser() != $this->getUser()){
                return $this->redirectToRoute('app_account_addresses');
            } 
        } else {

            $address = new Address();
            $address->setRelatedUser($this->getUser()); //pour reccuperer l'id d'user connecté 
        }

        $form = $this->createForm(AddressUserType::class, $address);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            $this->entityManager->persist($address);
            $this->entityManager->flush();
            
            $this->addFlash('success', 'Votre adrresse est sauvgardée !'); //NOTIFICATION 
                if ($cart->totalQuantity() > 0){

                return $this->redirectToRoute('app_order');
                }
            return $this->redirectToRoute('app_count_addresses');


        }
        
        return $this->render('account/address/form.html.twig', [
            'addressForm' => $form  
        ]);
    }
}
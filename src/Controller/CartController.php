<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\RequestStack; // Add this at the top


final class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    public function index(Cart $cart) //RequestStack $requestStack): Response
    
    {
        //$requestStack->getSession()->remove('cart');

        return $this->render('cart/index.html.twig', [
            'cart' => $cart->getCart(),
            'totalWt' => $cart->getTotalWt(),
        ]);
    }

#[Route('/cart/add/{id}/{origin}', name: 'app_cart_add', requirements: ['origin' => '.+'], defaults: ['origin' => ''])]
public function add($id, string $origin, Cart $cart, ProductRepository $productRepository): Response
{
    $product = $productRepository->findOneById($id);

    if (!$product) {
        throw $this->createNotFoundException('Produit introuvable.');
    }

    $cart->add($product);
    $this->addFlash('success', 'Produit est ajouté à votre panier!');

    // Decode the URL (it was encoded in the Twig template)
    $decodedOrigin = urldecode($origin);

    // Fallback route if origin is empty or unsafe
    if (empty($decodedOrigin) || !filter_var($decodedOrigin, FILTER_VALIDATE_URL)) {
        return $this->redirectToRoute('app_cart'); // fallback
    }

    return $this->redirect($decodedOrigin);
}
 

    #[Route('/cart/remove', name: 'app_cart_remove')]
    public function remove(Cart $cart): Response
    {
        
        $cart->remove();

        $this->addFlash('success', 'Votre panier est vide'); //NOTIFICATION 

        return $this->redirectToRoute('app_home');
    }

     #[Route('/cart/decrease/{id}', name: 'app_cart_decrease')]
    public function decrease($id, Cart $cart): Response
    {
        
        $cart->decrease($id);

        $this->addFlash('success', 'Votre produit a été retiré'); //NOTIFICATION 

        return $this->redirectToRoute('app_cart');
    }

 
}

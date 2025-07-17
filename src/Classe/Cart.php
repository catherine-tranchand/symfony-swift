<?php 

namespace App\Classe;

use Symfony\Component\HttpFoundation\RequestStack;

class Cart 
{
    public function __construct(private RequestStack $requestStack)
    {
    
    }

    /*
        * add()
        * Fonction permettant l'ajout d'un produit au panier
    */

    public function add($product)
    {
        $cart = $this->requestStack->getSession()->get('cart');
      
        if(isset($cart[$product->getId()])){

            $cart[$product->getId()] = [
                'object' => $product,
                'quantity' => $cart[$product->getId()]['quantity'] + 1
            ];
        } else {
            $cart[$product->getId()] = [
                'object' => $product,
                'quantity' => 1
            ];
        }

        $this->requestStack->getSession()->set('cart', $cart);
        

    }

    /*
        * getCart()
        * Fonction retournant le panier
    */

    public function getCart()
    {
        return $this->requestStack->getSession()->get('cart');
    }
    //Appeler la session de symfony 
    //Créer ma Session Cart
    //Ajouter un e qtity +1 à mon produit

    public function remove()
    {
      return $this->requestStack->getSession()->remove('cart');
        //Supprimer la session cart
        //On supprime le panier de la session
    }

    /*
        * decrease()
        * Fonction permettant la suppression d'une quantity d'un produit au panier
    */

 public function decrease($id)
{
    $cart = $this->requestStack->getSession()->get('cart');
    if ($cart[$id]['quantity'] > 1) {
        $cart[$id]['quantity'] -= 1; //  update the quantity
    } else {
        unset($cart[$id]);
    }

    $this->requestStack->getSession()->set('cart', $cart); // Save changes back to session
}



public function totalQuantity()
{
    $cart = $this->requestStack->getSession()->get('cart', []);
    $quantity = 0;

    foreach ($cart as $product){
        $quantity = $quantity + $product['quantity'];
    }

   return $quantity;

}

    /*
        * getTotalWt()
        * Fonction retournant le prix total au panier
    */

public function getTotalWt()
{
    $cart = $this->requestStack->getSession()->get('cart');
    $cart = is_array($cart) ? $cart : []; // Fallback to an empty array if $cart is null
    $price= 0;

    foreach ($cart as $product){
        $price = $price + ($product['object']->getPriceWt() * $product['quantity']);
    }

   return $price;
}

    
 }


<?php 

namespace App\Classe;

use Symfony\Component\HttpFoundation\RequestStack;

class Cart 
{
    public function __construct(private RequestStack $requestStack)
    {
    
    }

    public function add($product)
    {
        dd($product);
        $session = $this->requestStack->getSession()
    }
    //Appeler la session de symfony 
    //Créer ma Session Cart
    //Ajouter un e qtity +1 à mon produit
}
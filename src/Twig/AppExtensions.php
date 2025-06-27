<?php

namespace App\Twig;

use App\Classe\Cart;
use App\Repository\CategoryRepository;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;
use Twig\TwigFilter;


class AppExtensions extends AbstractExtension implements GlobalsInterface // pour ajouter les variables globales
{
    private $categoryRepository;
    private $cart;

    public function __construct(CategoryRepository $categoryRepository, Cart $cart)
    {

        $this->categoryRepository = $categoryRepository;
        $this->cart = $cart;

    }

    public function getFilters()
    {
        return [
            new TwigFilter('price', [$this, 'formatPrice']) //dans le parametre il faut mettre le nom de la foction
        ];
    }

    public function formatPrice($number)
    {
        return number_format($number). '€';
    }

    public function getGlobals( ): array
    {
        return [
            'allCategories' => $this->categoryRepository->findAll(),
            'totalCartQuantity' => $this->cart->totalQuantity(),

        ];
    }
}
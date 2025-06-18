<?php

namespace App\Twig;

use App\Repository\CategoryRepository;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;
use Twig\TwigFilter;

class AppExtensions extends AbstractExtension implements GlobalsInterface // pour ajouter les variables globales
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {

        $this->categoryRepository = $categoryRepository;

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
            'allCategories' => $this->categoryRepository->findAll(   )

        ];
    }
}
<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;


class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Produit')
            ->setEntityLabelInPlural('Produits');

    }

     
    public function configureFields(string $pageName): iterable
    {
        $required = true;

        if ($pageName === 'edit') {
            $required = false;
        }
        return [
           
            TextField::new('name')
                    ->setHelp('Nom de votre produit'),
            SlugField::new('slug')
                    ->setTargetFieldName('name')
                    ->setLabel('URL')->setHelp('URL de votre produit'),
            TextEditorField::new('description')
                   ->setLabel('description')
                   ->setHelp('Description de votre produit'),
            ImageField::new('image')
                   ->setLabel('Image')
                   ->setHelp('Image du produit en 600x600px')
                   ->setUploadedFileNamePattern('[year]-[month]-[day]-[contenthash].[extension]')
                   ->setBasePath('uploads/')  // Web path (no leading slash)
                   ->setUploadDir('public/uploads/')  // Filesystem path (relative to project root),
                   ->setRequired($required),
            NumberField::new('price')
                  ->setLabel('Prix H.T')
                  ->setHelp('Prix H.T du produit'),
            ChoiceField::new('tva')
                 ->setChoices([
                    '5,5%' => '5,5', // '5,5%' label visible pour l'utilisateur => '5,5' valeur stocké en bdd 
                    '10%' => '10',
                    '20%' => '20',
            ]),
            AssociationField::new('category', 'Categorie associée')

        ];
    }
    
}

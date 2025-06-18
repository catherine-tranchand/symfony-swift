<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\SlugType;

class CategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Category::class;
    }

      public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Categorie')
            ->setEntityLabelInPlural('Categories')
            ->setDateFormat('dd/MM/yyyy')
            ->setTimeFormat('H:i');
    }



    
    public function configureFields(string $pageName): iterable
    {
        return [
           
            TextField::new('name')->setLabel('titre')->setHelp('Titre de la catégorie'), 
            SlugField::new('slug')->setLabel('URL')->setTargetFieldName('name')->setHelp('URL de votre categorie générée automatiquement')
        ];
    }
    
}
 
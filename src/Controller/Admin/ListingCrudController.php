<?php

namespace App\Controller\Admin;

use App\Entity\Listing;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;


class ListingCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Listing::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title'),
            TextEditorField::new('description'),
            IntegerField::new("price"),
            TextField::new('city'),
            AssociationField::new('user_id')
            ->onlyOnForms(),
            AssociationField::new('property_type_id')
            ->onlyOnForms(),
            AssociationField::new('transaction_type_id')
            ->onlyOnForms(),
            
            
        ];
    }
    
}

<?php

namespace App\Controller\Admin;

use App\Entity\EtablissementDoctoral;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EtablissementDoctoralCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return EtablissementDoctoral::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nomEtablissement'),
            CollectionField::new('chefEtablissement')->allowAdd(false)->allowDelete(false)
        ];
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}

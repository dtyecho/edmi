<?php

namespace App\Controller\Admin;

use App\Entity\EtablissementDoctoral;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
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
            AssociationField::new('chefEtablissement')
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

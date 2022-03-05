<?php

namespace App\Controller\Admin;

use App\Entity\FormationDoctorale;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class FormationDoctoraleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return FormationDoctorale::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nomFormation'),
            CollectionField::new('responsable'),
            CollectionField::new('ecoleRattache'),
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

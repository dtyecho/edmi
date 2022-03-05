<?php

namespace App\Controller\Admin;

use App\Entity\Professeur;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class ProfesseurCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Professeur::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            EmailField::new('email'),
            TextField::new('password')->setFormType(PasswordType::class),
            TextField::new('name'),
            TextField::new('firstname'),
            ArrayField::new('roles'),
            DateTimeField::new('birthDate'),
            TextField::new('birthPlace'),
            TextField::new('adresse'),
            TextField::new('tel'),
            ChoiceField::new('grade')->setChoices([
                'Professeur' => 'Professeur',
                'Maître de conférence' => 'Maître de Conférence',
                'Directeur de Recherche' => 'Directeur de Recherche',
                'Maître de recherche' => 'Maître de Recherche',
                'HBR' => "Habilitation à diriger des recherches"
            ])
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

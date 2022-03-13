<?php

namespace App\Controller\Admin;

use App\Entity\Document;
use App\Entity\Dossier;
use App\Form\DocumentType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DossierCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Dossier::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('owner'),
            TextField::new('diplomeAcces', 'Diplôme d\'accès'),
            TextField::new('specialite', 'Spécialité'),
            TextField::new('univDelivreDiplome', 'Université ayant délivré le diplôme'),
            TextField::new('pays', 'Pays'),
            TextField::new('lieuObtentionDiplome', 'Lieu d\'obtention du diplôme'),
            DateTimeField::new('dateObtentionDiplome', 'Date d\'obtention du diplôme'),
            ChoiceField::new('mention')->setChoices([
                'Passable' => 'Passable',
                'Assez-bien' => 'Assez-bien',
                'Bien' => 'Bien',
                'Très bien' => 'Très bien',
                'Excellent' => 'Excellent'
            ]),
            AssociationField::new('formationDoctorale'),
            ChoiceField::new('avisDirecteurTheses')->setChoices([
                'Favorable' => 'Favorable',
                'Défavorable' => 'Défavorable',
            ]),
            ChoiceField::new('avisResponsableLabo')->setChoices([
                'Favorable' => 'Favorable',
                'Défavorable' => 'Défavorable',
            ]),
            ChoiceField::new('avisDirecteurEcoleDoctoral')->setChoices([
                'Favorable' => 'Favorable',
                'Défavorable' => 'Défavorable',
            ]),
            ChoiceField::new('avisResponsableDoctorat')->setChoices([
                'Favorable' => 'Favorable',
                'Défavorable' => 'Défavorable',
            ]),
            ChoiceField::new('avisChefEcoleRattache')->setChoices([
                'Favorable' => 'Favorable',
                'Défavorable' => 'Défavorable',
            ]),
            CollectionField::new('pieceJointe')->setEntryType(DocumentType::class)

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

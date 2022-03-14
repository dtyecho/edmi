<?php

namespace App\Form;

use App\Entity\Document;
use App\Entity\Dossier;
use App\Entity\FormationDoctorale;
use App\Entity\Professeur;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;

class DossierType extends FormConfig
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('owner', EtudiantType::class, $this->getConfiguration('','',[
                'label' => false,
                'attr' => [

                ]
            ]))
            ->add('diplomeAcces', ChoiceType::class, $this->getConfiguration('Diplôme d\'accès', '', [
                'choices' => [
                    'Master' => 'Master',
                    'DIC' => 'Diplôme d\'Ingénieur de conception',
                    'Diplôme d\'Ingénieur' => 'Diplôme d\'Ingénieur'
                ],
                'attr' => [

                ]
            ]))
            ->add('specialite', TextType::class, $this->getConfiguration('Spécialité', '', [
                'attr' => [

                ]
            ]))
            ->add('UnivDelivreDiplome', TextType::class, $this->getConfiguration('Université ayant délivré le diplôme', '',[
                'attr' => [

                ]
            ]))
            ->add('pays', TextType::class, $this->getConfiguration('Pays', '', [
                'attr' => [

                ]
            ]))
            ->add('lieuObtentionDiplome', TextType::class, $this->getConfiguration('Lieu d\'obtention du diplôme', '', [
                'attr' => [

                ]
            ]))
            ->add('dateObtentionDiplome', DateType::class, $this->getConfiguration('Date d\'obtention du diplôme', '',[
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'js-datepicker form-group'
                ]
            ]))
            ->add('mention', ChoiceType::class, $this->getConfiguration('Mention', '', [
                'choices' => [
                    'Passable' => 'Passable',
                    'Assez-bien' => 'Assez-bien',
                    'Bien' => 'Bien',
                    'Très_bien' => 'Très-bien',
                    'Excellent' => 'Excellent'
                ],
                'attr' => [

                ]
            ]))
            ->add('formationDoctorale', EntityType::class, $this->getConfiguration('Formation doctorale', '',[
                'class' => FormationDoctorale::class,
                'choice_label' => 'nomFormation',
                'required' => true,
                'multiple' => true,
                'attr' => [
                    'class' => ''
                ]
            ]))
            ->add('themeRecherche', TextType::class, $this->getConfiguration('Thème de la recherche','', [
                'attr' => [

                ]
            ]))
            ->add('directeurThese', EntityType::class, $this->getConfiguration('Directeur de thèse', '', [
                'class' => Professeur::class,
                'choice_label' => 'firstname'. ' '. 'name',
                'required' => true,
            ]))
            ->add('avisDirecteurTheses', ChoiceType::class, $this->getConfiguration('Avis du directeur de thèse', '', [
                'choices' => [
                    'Favorable' => 'Favorable',
                    'Défavorable' => 'Défavorable'
                ],
                'attr' => [

                ]
            ]))
            ->add('avisResponsableLabo',ChoiceType::class, $this->getConfiguration('Avis du directeur de thèse', '', [
                'choices' => [
                    'Favorable' => 'Favorable',
                    'Défavorable' => 'Défavorable'
                ],
                'attr' => [

                ]
            ]))
            ->add('avisResponsableDoctorat', ChoiceType::class, $this->getConfiguration('Avis du directeur de thèse', '', [
                'choices' => [
                    'Favorable' => 'Favorable',
                    'Défavorable' => 'Défavorable'
                ],
                'attr' => [

                ]
            ]))
            ->add('avisDirecteurEcoleDoctoral', ChoiceType::class, $this->getConfiguration('Avis du directeur de thèse', '', [
                'choices' => [
                    'Favorable' => 'Favorable',
                    'Défavorable' => 'Défavorable'
                ],
                'attr' => [

                ]
            ]))
            ->add('avisChefEcoleRattache', ChoiceType::class, $this->getConfiguration('Avis du directeur de thèse', '', [
                'choices' => [
                    'Favorable' => 'Favorable',
                    'Défavorable' => 'Défavorable'
                ],
                'attr' => [

                ]
            ]))
            ->add('pieceJointe', CollectionType::class, $this->getConfiguration('Pièces Jointes', '', [
                'entry_type' => DocumentType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true
            ]))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Dossier::class,
        ]);
    }
}

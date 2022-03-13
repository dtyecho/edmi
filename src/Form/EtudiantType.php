<?php

namespace App\Form;

use App\Entity\Etudiant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EtudiantType extends FormConfig
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, $this->getConfiguration('Email', '', [
                'attr' => [
                    'class' => 'form-group'
                ]
            ]))
            ->add('name', TextType::class, $this->getConfiguration('Nom', '', [
                'attr' => [
                    'class' => 'form-group'
                ]
            ]))
            ->add('firstname', TextType::class, $this->getConfiguration('Prenom', '', [
                'attr' => [
                    'class' => 'form-group'
                ]
            ]))
            ->add('birthDate', DateType::class, $this->getConfiguration('Date de naissance', '', [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'js-datepicker form-group'
                ]
            ]))
            ->add('birthPlace', TextType::class, $this->getConfiguration('Lieu de naissance', '', [
                'attr' => [
                    'class' => 'form-group'
                ]
            ]))
            ->add('adresse', TextType::class, $this->getConfiguration('Adresse', '', [
                'attr' => [
                    'class' => 'form-group'
                ]
            ]))
            ->add('tel', TelType::class, $this->getConfiguration('Téléphone', '', [
                'attr' => [
                    'class' => 'form-group'
                ]
            ]))
            ->add('numCarteEtudiant', TextType::class, $this->getConfiguration('Numéro carte étudiant', 'Entrez le numero une fois inscrit', [
                'attr' => [
                    'class' => 'form-group'
                ]
            ]))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Etudiant::class,
        ]);
    }
}

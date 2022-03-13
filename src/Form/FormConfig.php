<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;

class FormConfig extends AbstractType
{
    //configuration des options des formulaires

    public function  getConfiguration($label, $placeholder, $options = []): array
    {
        return array_merge([
            'label' => $label,
            'attr' => [
                'placeholder' => $placeholder
            ]
        ], $options);
    }
}
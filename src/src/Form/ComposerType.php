<?php

namespace App\Form;

use App\Entity\Composer;
use DateTime;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ComposerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $today = new DateTime();
        $lastDeathYear = $today->format('Y');
        $lastBirthYear = $today->modify('-10 years');
        $lastBirthYear = $lastBirthYear->format('Y');

        $builder
            ->add('name')
            ->add('birthDate', DateType::class, ['years' => range($lastBirthYear, 1600)])
            ->add('deathDate', DateType::class, ['years' => range($lastDeathYear, 1600)])
            ->add('styles')
            ->add('catalogue', CatalogueType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Composer::class,
        ]);
    }
}

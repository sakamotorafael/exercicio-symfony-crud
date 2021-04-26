<?php

namespace App\Form;

use App\Entity\Composer;
use DateTime;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ComposerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $today = new DateTime();
        $startYear = 1600;
        $endYear = $today->format('Y');
        $today->modify('-10 years');
        $endBithYear = $today->format('Y');

        $builder
            ->add('name')
            ->add('nationality')
            ->add('birthDate', DateType::class, ['years' => range($startYear, $endBithYear), 'label_format' => 'Birth'])
            ->add('deathDate', DateType::class, ['years' => range($startYear, $endYear), 'label_format' => 'Death'])
            ->add('mainStyle', TextType::class, ['label_format' => 'Main style'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Composer::class,
        ]);
    }
}
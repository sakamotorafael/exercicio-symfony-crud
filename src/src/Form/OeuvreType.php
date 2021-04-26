<?php

namespace App\Form;

use App\Entity\Oeuvre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class OeuvreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label_format' => 'Title'])
            ->add('opus', NumberType::class, ['label_format' => "Op."])
            ->add('number', NumberType::class, ['label_format' => 'number', 'required' => false])
            ->add('tonality', TextType::class, ['label_format' => 'Tonality'])
            ->add('catalogName', TextType::class, ['label_format' => 'Catalog', 'required' => false])
            ->add('catalogNumber', NumberType::class, ['label_format' => 'number', 'required' => false])
            ->add('genre', TextType::class, ['label_format' => 'Genre'])
            ->add('composer', TextType::class, ['label_format' => 'Composer'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Oeuvre::class,
        ]);
    }
}

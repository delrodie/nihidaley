<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InformationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', TextType::class,[
                'attr' => ['class'=>'form-control', 'placeholder'=>'le type d\'information']
            ])
            ->add('libelle', TextType::class,[
                'attr' => ['class'=>'form-control', 'placeholder'=>'l\'information']
            ])
            ->add('statut', CheckboxType::class,['required'=>false])
            ->add('datedeb', TextType::class,[
                'attr' => ['class'=>'form-control', 'placeholder'=>'la date debut de publication ']
            ])
            ->add('datefin', TextType::class,[
                'attr' => ['class'=>'form-control', 'placeholder'=>'la date fin de publication']
            ])
            //->add('slug')->add('publiePar')->add('modifiePar')->add('publieLe')->add('modifieLe')
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Information'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_information';
    }


}

<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ComOperationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('identite', TextType::class,[
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Identité du membre'
                ]
            ])
            ->add('fonction', TextType::class,[
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'La fonction du membre'
                ]
            ])
            ->add('mission', TextareaType::class,[
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'La mission assignée'
                ]
            ])
            ->add('activite', TextareaType::class,[
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Activités du membre'
                ]
            ])
            ->add('contact', TextType::class,[
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Le contact du membre'
                ],
                'required' => false
            ])
            ->add('email', TextType::class,[
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Adresse email du membre'
                ],
                'required' => false
            ])
            ->add('statut', CheckboxType::class,[
                'required' => false
            ])
            ->add('imageFile', VichImageType::class,[
                'required' => false,
                'allow_delete' => true,
                'label' => '.',
            ])
            //->add('imageSize')->add('updatedAt')->add('slug')->add('publiePar')->add('modifiePar')->add('publieLe')->add('modifieLe')
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\ComOperation'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_comoperation';
    }


}

<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ComGeneralType extends AbstractType
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
                    'placeholder' => 'Identité de la personne'
                ]
            ])
            ->add('fonction', TextType::class,[
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'fonction de la personne'
                ]
            ])
            ->add('mission', TextareaType::class,[
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            ->add('activite', TextareaType::class,[
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Les activités dediées à la personne',
                    'style' => 'width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;'
                ]
            ])
            ->add('contact', TextType::class,[
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'le contact de la personne'
                ],
                'required' => false
            ])
            ->add('email', TextType::class,[
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Email de la personne'
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
            'data_class' => 'AppBundle\Entity\ComGeneral'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_comgeneral';
    }


}

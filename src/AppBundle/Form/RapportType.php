<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class RapportType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class,[
                'attr' =>['class' => 'form-control', 'placeholder'=> 'le titre du rapport']
            ])
            ->add('description', TextareaType::class,[
                'attr' =>[
                    'class' => 'form-control',
                    'placeholder' => 'le resumé du rapport',
                    'style' => 'width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;'
                ]
            ])
            ->add('tags', TextType::class,[
                'attr' => ['class' => 'from-control', 'placeholder' => 'Les mots du rapport', 'data-role' => 'tagsinput']
            ])
            ->add('date', TextType::class,[
                'attr' => ['class'=> 'form-control', 'placeholder'=> 'La date d\'activité']
            ])
            ->add('album', TextType::class,[
                'attr' => ['class'=> 'form-control', 'placeholder'=> 'le lien de l\'album photos correspondant'],
                'required'=> false
            ])
            ->add('statut', CheckboxType::class, ['required' => false])
            ->add('imageFile', VichImageType::class,[
                'required' => false, 'allow_delete' => true, 'label' => '.'
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
            'data_class' => 'AppBundle\Entity\Rapport'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_rapport';
    }


}

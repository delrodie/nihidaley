<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class TourismeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle', TextType::class,[
                'attr' => ['class' => 'form-control','placeholder' => 'le libelle du site']
            ])
            ->add('description', TextareaType::class,[
                'attr' => [
                    'class' => 'form-control', 'placeholder' => 'la description du site',
                    'style' => 'width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;'
                ]
            ])
            //->add('resume')
            ->add('localisation', TextType::class,[
                'attr' => ['class' => 'form-control', 'placeholder'=> 'la localisation google map du site']
            ])
            ->add('statut', CheckboxType::class, ['required'=> false ])
            ->add('tags', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => "Les mots clés",
                    'data-role' => 'tagsinput',
                ],
                'required' => false,
            ] )
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
            'data_class' => 'AppBundle\Entity\Tourisme'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_tourisme';
    }


}

<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class GaleriePhotoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('imageFile', VichImageType::class,[
                'required' => false, 'allow_delete' => true, 'label' => '.'
            ])
            //->add('imageSize')->add('updatedAt')
            ->add('album', null, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'selectionnez l\'album photo'
                ],
                'class' => 'AppBundle:Galerie',
                'query_builder' => function(EntityRepository $er){
                    return $er->findList();
                },
                'choice_label' => 'titre'
            ])
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\GaleriePhoto'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_galeriephoto';
    }


}

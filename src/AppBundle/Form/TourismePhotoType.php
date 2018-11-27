<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class TourismePhotoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('imageFile', VichImageType::class,[
                'required' => false,
                'allow_delete' => true,
                'label' => '.',
            ])
            //->add('imageSize')->add('updatedAt')
            ->add('tourisme', null, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'selectionnez le lieu'
                ],
                'class' => 'AppBundle:Tourisme',
                'query_builder' => function(EntityRepository $er){
                    return $er->findList();
                },
                'choice_label' => 'libelle'
            ])
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\TourismePhoto'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_tourismephoto';
    }


}

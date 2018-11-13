<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class PresidenceType extends AbstractType
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
                    'placeholder' => 'Identité du vice president'
                ]
            ])
            ->add('fonction', TextType::class,[
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'fonction du vice president'
                ]
            ])
            ->add('mission', TextareaType::class,[
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('activite', TextareaType::class,[
                'attr' => [
                    'class' => 'form-control',
                    'style' => 'width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;'
                ]
            ])
            ->add('contact', TextType::class,[
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Contact telephonique'
                ],
                'required' => false
            ])
            ->add('email', TextType::class,[
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Adresse email du vice president'
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
            ->add('type', null, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'selectionnez le titre'
                ],
                'class' => 'AppBundle:TypePresidence',
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
            'data_class' => 'AppBundle\Entity\Presidence'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_presidence';
    }


}

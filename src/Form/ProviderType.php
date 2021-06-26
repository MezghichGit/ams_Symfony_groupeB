<?php

namespace App\Form;

use App\Entity\Provider;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

class ProviderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('email', TextType::class, array(
    
                'attr' => array(
                    'placeholder' => 'Un email valide'
                )
           ))
            ->add('adress')
            ->add('logo', FileType::class, [
                'label' => 'Photo de profil (png/jpg)',
                // unmapped means that this field is not associated to any entity property
                'mapped' => false,
                // make it optional so you don't have to reupload the PDF file
                // every time you edit the Product details
                'required' => false,
                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraintclasses
                'constraints' => [
                new File([
                'maxSize' => '3024k',
                'mimeTypes' => [
                'image/png',
                'image/jpeg',
                'image/jpg',
                ],
                'mimeTypesMessage' => 'Please upload a valid picture format',
                ])
                ],
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Provider::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Decouverte;
use App\Entity\Continent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class DecouverteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
            	'constraints' => [
            		new NotBlank([
            		    'message' => "Le nom est obligatoire"
		            ])
	            ],
                'attr' => ['class' => 'form-control']
            ])
            ->add('pays', TextType::class, [
            	'constraints' => [
            		new NotBlank([
            		    'message' => "Le pays est obligatoire"
		            ])
	            ],
                'attr' => ['class' => 'form-control']
            ])
            ->add('article', TextareaType::class, [
            	'constraints' => [
            		new NotBlank([
            		    'message' => "Le contenu de l'article est obligatoire"
		            ])
	            ],
                'attr' => ['class' => 'form-control']
            ])
            ->add('image', TextType::class, [])
            ->add('continent', EntityType::class, [
				'class' => Continent::class,
	            'choice_label' => 'name',
	            'placeholder' => '',
	            'constraints' => [
	            	new NotBlank([
	            	    'message' => 'Le continent est obligatoire'
		            ])
	            ],
                'attr' => ['class' => 'form-control']
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Decouverte::class,
        ]);
    }
}

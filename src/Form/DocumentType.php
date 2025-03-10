<?php

namespace App\Form;

namespace App\Form;

use App\Entity\Document;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class DocumentType extends AbstractType
{
    
        public function buildForm(FormBuilderInterface $builder, array $options): void
        {
            $builder
            
                ->add('type')
                ->add('titre')
                ->add('datecreation', DateType::class, [
                    'label' => ' Date de création',
                    'widget' => 'single_text',
                ])
                ->add('description')
                ->add('version')
                ->add('validation', ChoiceType::class, [
                    'choices'  => [
                        
                        'Yes' => true,
                        'No' => false,
                    ],
                    'required'   => false,
                ])
                ->add('datevalidation', DateType::class, [
                    'label' => ' Date de validation',
                    'widget' => 'single_text',
                    'required'   => false,
                ])
                ->add('approbation', ChoiceType::class, [
                    'choices'  => [
                        
                        'Yes' => true,
                        'No' => false,
                    ],
                    'required'   => false,
                ])
                ->add('dateapprobation', DateType::class, [
                    'label' => ' Date approbation',
                    'widget' => 'single_text',
                    'required'   => false,
                ])
                ->add('archivage', ChoiceType::class, [
                    'choices'  => [
                        
                        'Yes' => true,
                        'No' => false,
                    ],
                    'required'   => false,
                ])
                ->add('datearchivage', DateType::class, [
                    'label' => ' Date archivage',
                    'widget' => 'single_text',
                    'required'   => false,
                ])
                ->add('file', FileType::class, array('data_class' => null,'required' => false))
            ;
        }
    
        public function configureOptions(OptionsResolver $resolver): void
        {
            $resolver->setDefaults([
                'data_class' => Document::class,
            ]);
        }
    }
    
<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Document;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Repository\DocumentRepository;

class Categorie1Type extends AbstractType

{
    private $decRepository;

    public function __construct(DocumentRepository $decRepository)
    {
        $this->decRepository = $decRepository;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libcat', TextType::class, [
                'label' => ' Libellé catégorie',
                'attr' => [
                    'placeholder' => ''
                ]
            ])
            ->add('description')
            ->add('nom')
            ->add('docategorie', EntityType::class, [
                'label' => ' Catégorie document',
                'class' => Document::class,
                'choices' => $this->decRepository->findAll(),
                'mapped' => false,
                'multiple'  => true
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Categorie::class,
        ]);
    }
}

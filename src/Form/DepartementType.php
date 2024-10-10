<?php

namespace App\Form;

use App\Entity\Departement;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Repository\UserRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class DepartementType extends AbstractType
{
    private $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        
        $builder
            ->add('nom', TextType::class, [
                'label' => ' Nom département',
                'attr' => [
                    'placeholder' => ''
                ]
            ])
            ->add('lib_dep', TextType::class, [
                'label' => ' libellé département',
                'attr' => [
                    'placeholder' => ''
                ]
            ])
            ->add('description')
            ->add('datecreation', DateType::class, [
                'label' => ' Date de création',
                'widget' => 'single_text',
            ])
         
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Departement::class,
        ]);
    }


}

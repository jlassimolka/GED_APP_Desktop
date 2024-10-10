<?php

namespace App\Form;

use App\Entity\Processus;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Repository\UserRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ProcessusType extends AbstractType
{
    private $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('datecreation', DateType::class, [
                'label' => ' Date de création',
                'widget' => 'single_text',
            ])
            ->add('libprocessus',TextType::class, [
                'label' => ' libellé processus',
                'attr' => [
                    'placeholder' => ''
                ]
            ])
            ->add('description')
            ->add('userproc', EntityType::class, [
                'label' => ' Utilisateurs processus',
                'class' => User::class,
                'choices' => $this->userRepository->findAllUsers(),
                'mapped' => false,
                'multiple'  => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Processus::class,
        ]);
    }
}

<?php


namespace App\Form;

use App\Entity\User;
use App\Entity\Departement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Repository\DepartementRepository;
use Symfony\component\form\Extension\Core\Type\TextType;

class EdituserType extends AbstractType
{
    private $depRepository;

    public function __construct(DepartementRepository $depRepository)
    {
        $this->depRepository = $depRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
    
        $builder
            ->add('email')
            ->add('fullname', TextType::class, array(
                'label' => ' Nom et Prénom',
                'attr' => array(
                    'placeholder' => ''
                )
           ))
            ->add('tel',TextType::class, array(
                'label' => 'Téléphone',
                'attr' => array(
                    'placeholder' => '')
            ))
            ->add('roles', ChoiceType::class, [
                'required' => true,
                'multiple' => false,
                'expanded' => false,
                'choices'  => [
                  'Validateur' => 'ROLE_VALIDATEUR',
                  'Redacteur' => 'ROLE_REDACTEUR',
                  'Aprobateur' => 'ROLE_APROBATEUR',
                  'Administrateur' => 'ROLE_ADMINISTRATEUR',
                  'Archivé' => 'ROLE_ARCHIVÉ',
                ],
            ])
            ->add('departements', EntityType::class, [
                'class' => Departement::class,
                'choices' => $this->depRepository->findAllDepartements(),
                'mapped' => false,
                'multiple'  => true
            ])
          
        ;
        $builder->get('roles')
        ->addModelTransformer(new CallbackTransformer(
            function ($rolesArray) {
                 // transform the array to a string
                 return count($rolesArray)? $rolesArray[0]: null;
            },
            function ($rolesString) {
                 // transform the string back to an array
                 return [$rolesString];
            }
    ));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

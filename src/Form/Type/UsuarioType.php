<?php 

namespace App\Form\Type;

use App\Entity\Usuario;
use App\Security\Roles;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsuarioType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('nomeUsuario', TextType::class)
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'As senhas precisam ser iguais!',
                'required' => true,
                'options' => [
                    'attr' => [
                        'class'=>'password-field'
                    ]
                ],
                'first_options'=> [
                    'label'=>'Senha'
                ],
                'second_options'=> [
                    'label'=>'Repita a Senha'
                ]
            ])
            ->add('roles',  ChoiceType::class, [
                'label'=>'Permissões',
                'choices' => Roles::get(),
                'expanded' => false,
                'multiple' => true
            ]) 
            ->add('salvar', SubmitType::class)
            ->add('limpar', ResetType::class);
        
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Usuario::class
        ]);
    }
}
<?php

namespace App\Form\Type;

use App\Entity\Socio;
use App\Entity\Empresa;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SocioType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options): void {
            $builder
                ->add('cpf', TextType::class, [
                    'label'=>'CPF',
                    'attr' => [
                        'data-mask'=>'000.000.000-00',
                        'minlength'=>'14'
                    ]
                ])
                ->add('nome', TextType::class)
                ->add('endereco', TextType::class, [
                    'label'=>'Endereço'
                ])
                ->add('telefone', TelType::class, [
                    'attr' => [
                        'data-mask'=>'(00) 0 0000-0000',
                        'minlength'=>'16'
                    ]
                ])
                ->add('empresas', EntityType::class, [
                    'class' => Empresa::class,
                    'choices' => $options['empresas'],
                    'choice_label' => 'razaoSocial',
                    'multiple' => true,
                    'expanded' => false,
                ])
                ->add('salvar', SubmitType::class)
                ->add('limpar', ResetType::class)
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void {
        $resolver->setDefaults([
            'data_class' => Socio::class,
            'empresas' => new ArrayCollection()
        ]);
    }
}
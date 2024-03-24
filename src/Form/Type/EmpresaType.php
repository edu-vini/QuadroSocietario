<?php

namespace App\Form\Type;

use App\Entity\Empresa;
use App\Entity\Socio;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmpresaType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder
        ->add('cnpj', TextType::class, [
            'label'=>'CNPJ',
            'attr' => [
                'data-mask' => '00.000.000/0000-00',
                'minlength' => 18
            ]
        ])
        ->add('razaoSocial', TextType::class, [
            'label'=> 'Razão Social'
        ])
        ->add('fantasia', TextType::class)
        ->add('endereco', TextType::class, [
            'label'=>'Endereço'
        ])
        ->add('telefone', TextType::class, [
            'attr' => [
                'data-mask' => '(00) 0 0000-0000',
                'minlength' => 16
            ]
        ])
        ->add('salvar', SubmitType::class)
        ->add('limpar', ResetType::class)
    ;
    }

    public function configureOptions(OptionsResolver $resolver): void {
        $resolver->setDefaults([
            'data_class' => Empresa::class,
            'socios' => new ArrayCollection()
        ]);
    }
}
<?php

namespace App\Form\Type;

use App\Entity\Empresa;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmpresaType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
            $builder
                ->add('cnpj', TextType::class)
                ->add('razaoSocial', TextType::class)
                ->add('fantasia', TextType::class)
                ->add('endereco', TextType::class)
                ->add('telefone', TelType::class)
                ->add('salvar', SubmitType::class)
                ->add('limpar', ResetType::class)
            ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Empresa::class
        ]);
    }
}
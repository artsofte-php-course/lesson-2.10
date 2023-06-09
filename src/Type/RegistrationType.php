<?php

namespace App\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType {


    function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', TextType::class)
                ->add('password', RepeatedType::class, [
                    'type' => PasswordType::class,
                    'invalid_message' => 'Password must be match.',
                    'required' => true,
                    'first_options' => ['label' => 'Password'],
                    'second_options' => ['label' => 'Repeat password'],
                ])
                ->add('signup', SubmitType::class);
    }

}
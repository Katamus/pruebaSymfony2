<?php


namespace App\form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class RegisterType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombreUsuario',TextType::class,array(
            'label' => 'Nombre'
        ))->add('correo',EmailType::class,array(
            'label' => 'Correo electronico'
        ))->add('clave',PasswordType::class,array(
            'label' => 'password'
        ))->add('submit',SubmitType::class,array(
            'label' => 'Registro'
        ));
    }

}
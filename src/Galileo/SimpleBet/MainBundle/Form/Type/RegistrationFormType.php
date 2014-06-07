<?php

namespace Galileo\SimpleBet\MainBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', 'email', array('label' => 'Nazwa użytkownika'))
            ->add('email', 'email', array('label' => 'Email'))
            ->add('plainPassword', 'repeated', array(
                    'type' => 'password',
                    'first_options' => array('label' => 'Hasło'),
                    'second_options' => array('label' => 'Powtórz hasło'),
                    'invalid_message' => 'fos_user.password.mismatch',
                ))
        ;
        $builder->add('firstName', 'text', array('label' => 'Imię'));
        $builder->add('lastName', 'text', array('label' => 'Nazwisko'));
        $builder->add('displayName', 'text', array('label' => 'Nazwa wyświetlana innym użytkownikom'));

    }

    public function getName()
    {
        return 'gsbm_user_registration';
    }

}


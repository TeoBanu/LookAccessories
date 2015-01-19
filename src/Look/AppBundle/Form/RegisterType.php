<?php

namespace Look\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('address', new AddressType());
        $builder->add('first_name');
        $builder->add('last_name');
        $builder->add('gender', 'choice', array(
            'choices' => array(
                'M' => 'Male',
                'F' => 'Female'
            ),
        ));
        $builder->add('phone_number');
        $builder->add('email');
        $builder->add('username');
        $builder->add('password', 'repeated', array(
           'first_name'  => 'password',
           'second_name' => 'confirm',
           'type'        => 'password'
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Look\AppBundle\Entity\User'
        ));
    }

    public function getName()
    {
        return 'user';
    }
}
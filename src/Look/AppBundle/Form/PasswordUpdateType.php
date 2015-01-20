<?php

namespace Look\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PasswordUpdateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('password', 'repeated', array(
           'first_name'  => 'password',
           'second_name' => 'confirm',
           'type'        => 'password',
           'first_options'  => array('label' => 'New password'),
           'second_options' => array('label' => 'Confirm password')
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
<?php

namespace Look\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
		$builder->add('country');
		$builder->add('city');
		$builder->add('region');
		$builder->add('street');
		$builder->add('number');
		$builder->add('apartment');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Look\AppBundle\Entity\Address'
        ));
    }

    public function getName()
    {
        return 'address';
    }
}
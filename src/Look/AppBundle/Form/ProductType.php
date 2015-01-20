<?php

namespace Look\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
        $builder->add('price');
        $builder->add('stock');
        $builder->add('category', 'choice', array(
            'choices' => array(
                'Bracelets' => 'Bracelets', 
                'Earrings' => 'Earrings', 
                'Handbags' => 'Handbags', 
                'Necklaces' => 'Necklaces', 
                'Watches' => 'Watches'
            ),
        ));
        $builder->add('brand');
        $builder->add('description', 'textarea', array(
            'attr' => array('cols' => '40', 'rows' => '10'),
        ));
        $builder->add('file');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Look\AppBundle\Entity\Product'
        ));
    }

    public function getName()
    {
        return 'product';
    }
}
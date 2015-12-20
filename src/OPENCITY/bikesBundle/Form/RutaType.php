<?php

namespace OPENCITY\bikesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RutaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('stationOrigin')
            ->add('stationArrival')
            ->add('duration')
            ->add('kilometers')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OPENCITY\bikesBundle\Entity\Ruta'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'opencity_bikesbundle_ruta';
    }
}

<?php

namespace OPENCITY\bikesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FavoriteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

      $builder->add('Station', 'entity', array(
          'class' => 'OPENCITYbikesBundle:Station',
          'choice_label' => 'name',
      ));
    }



    /**
     * @return string
     */
    public function getName()
    {
        return 'opencity_bikesbundle_station';
    }
}

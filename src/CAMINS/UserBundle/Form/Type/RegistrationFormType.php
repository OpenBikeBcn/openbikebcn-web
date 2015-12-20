<?php

namespace CAMINS\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegistrationFormType extends AbstractType
{

		private $class;

		public function __construct($class, $roles_hierarchy = null)
		{
				$this->roles_hierarchy = $roles_hierarchy;
				$this->class = $class;
		}

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
					->add('email', 'email', array('label' => 'Email'))
					->add('username', null, array('label' => 'Username'))
					->add('plainPassword', 'repeated', array(
							'type' => 'password',
							'first_options' => array('label' => 'Password'),
							'second_options' => array('label' => 'Repeat password'),
							'invalid_message' => 'Invalid username or password'
					))
					;
    }

    /*public function getParent()
    {
        return 'fos_user_registration';
    }*/

    public function getName()
    {
        return 'camins_user_registration';
    }

		public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->class,
            'intention'  => 'registration',
        ));
    }

    // BC for SF < 2.7
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $this->configureOptions($resolver);
    }

}

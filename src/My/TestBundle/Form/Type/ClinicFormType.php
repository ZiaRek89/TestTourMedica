<?php 

namespace My\TestBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ClinicFormType extends AbstractType {

	public function getName(){

		return 'Clinic_form';
	}

	public function buildForm(FormBuilderInterface $builder, array $options){

		$builder
				->add('name', 'text', [
		    		  	'required' => true
		    ])
				->add('patients', 'collection', [
						'type' => new PatientFormType(),
						'label' => ' '
			]);
	}

	public function setDefaultOptions(OptionsResolverInterface $resolver){

		$resolver->setDefaults(['data_class' => 'My\TestBundle\Entity\Clinic']);
	}
}
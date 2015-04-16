<?php 

namespace My\TestBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PatientFormType extends AbstractType {

	public function getName(){

		return 'Patient_form';
	}

	public function buildForm(FormBuilderInterface $builder, array $options){

		$builder
				->add('firstName', 'text', [
		    		  'required' => true,
		    		  'label' => 'Imię : ' 
		    ])
				->add('lastName', 'text', [
		    		  'required' => true,
		    		  'label' => 'Nazwisko : ' 
		    ])
				->add('pesel', 'pesel', [
		    		  'required' => true,
		    		  'label' => 'Pesel : ' 
		    ])
				->add('dateBirth', 'date', [
		    		  'required' => true,
		    		  'label' => 'Data urodzenia : ' 
		    ]);
	}

	public function setDefaultOptions(OptionsResolverInterface $resolver){

		$resolver->setDefaults(['data_class' => 'My\TestBundle\Entity\Patient']);
	}
}
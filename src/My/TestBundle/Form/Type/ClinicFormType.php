<?php

namespace My\TestBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class ClinicFormType extends AbstractType
{
    protected $em;

    public function __construct($em)
    {
        $this->em = $em;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('name', 'text', [
                        'required' => true,
            ])
                ->add('patients', 'collection', [
                        'type' => new PatientFormType(),
                        'label' => ' ',
            ]);

        $builder->addEventListener(FormEvents::POST_SUBMIT, [$this, 'onPostSubmit']);
    }

    public function onPostSubmit(FormEvent $event)
    {
        $form = $event->getForm();
        $data = $event->getData();

        if ($form->isValid()) {
            $this->em->persist($data);
            $this->em->flush();
        }
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(['data_class' => 'My\TestBundle\Entity\Clinic']);
    }

    public function getName()
    {
        return 'Clinic_form';
    }
}

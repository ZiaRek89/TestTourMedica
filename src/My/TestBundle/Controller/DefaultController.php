<?php

namespace My\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

use My\TestBundle\Form\Type\ClinicFormType;
use My\TestBundle\Form\Type\PatientFormType;

use My\TestBundle\Entity\Clinic;
use My\TestBundle\Entity\Patient;

use My\TestBundle\Event\UppercaseEvent; 

class DefaultController extends Controller
{

    /**
     * @Route("/", name="home")
     * @Template()
     */
    public function showAllAction()
    {

        $em = $this->getDoctrine()->getManager();
        $clinics = $em->getRepository('MyTestBundle:Clinic')->findAll();

        return ['clinics' => $clinics];
    }

    /**
     * @Route("/addClinic", name="add")
     * @Template()
     */
    public function addAction(Request $request)
    {

        $clinic = new Clinic();

        $form = $this->createForm(new ClinicFormType, $clinic);
        $form->remove('patients');

        $form->handleRequest($request);

            if ($form->isValid()) {
           
                $em = $this->getDoctrine()->getManager();
                $em->persist($clinic);
                $em->flush();
                return $this->redirect($this->generateUrl('home'));
            }

        return ['clinicForm' => $form->createView()];
    }

    /**
     * @Route("/editClinic/{action}/{id}", name="edit")
     */
    public function editAction(Request $request, $action, $id)
    {

        $em = $this->getDoctrine()->getManager();
        $clinic = $em->getRepository('MyTestBundle:Clinic')->findOneById($id);

        if($action=='addPatient'){
           $newPatient = new Patient();
           $clinic->addPatient($newPatient);
        }

        $form = $this->createForm(new ClinicFormType, $clinic);

        $form->handleRequest($request);

            if ($form->isValid()) {
           
                $em->persist($clinic);
                $em->flush();

                $dispatcher = $this->get('event_dispatcher'); 
                $dispatcher->dispatch('my.events.up', new UppercaseEvent($em, $clinic));

                if($action=='addPatient'){
                    return $this->redirect($this->generateUrl('edit', ['action' => 'addPatient', 'id' => $id]));
                }
            }

        return $this->render('MyTestBundle:Default:edit.html.twig', ['clinicForm' => $form->createView()]);
    }

}

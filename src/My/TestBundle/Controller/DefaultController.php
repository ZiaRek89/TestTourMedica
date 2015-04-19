<?php

namespace My\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use My\TestBundle\Form\Type\ClinicFormType;
use My\TestBundle\Entity\Clinic;
use My\TestBundle\Entity\Patient;

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
    public function showAddFormAction(Request $request)
    {
        $clinic = new Clinic();

        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(new ClinicFormType($em), $clinic);
        $form->remove('patients');

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            return $this->redirect($this->generateUrl('home'));
        }

        return ['clinicForm' => $form->createView()];
    }

    /**
     * @Route("/editClinic/{action}/{id}", name="edit")
     */
    public function showEditFormAction(Request $request, $action, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $clinic = $em->getRepository('MyTestBundle:Clinic')->findOneById($id);

        if ($action == 'addPatient') {
            $newPatient = new Patient();
            $clinic->addPatient($newPatient);
        }

        $form = $this->createForm(new ClinicFormType($em), $clinic);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($action == 'addPatient') {
                if ($form->getErrorsAsString()) {
                    $this->get('session')->getFlashBag()->add('error', explode('ERROR:', $form->getErrorsAsString())[1]);
                }

                return $this->redirect($this->generateUrl('edit', ['action' => 'addPatient', 'id' => $id]));
            }
        }

        return $this->render('MyTestBundle:Default:showEditForm.html.twig', ['clinicForm' => $form->createView()]);
    }
}

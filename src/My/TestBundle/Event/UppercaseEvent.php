<?php

namespace My\TestBundle\Event;
     
use Symfony\Component\EventDispatcher\Event;
     
    class UppercaseEvent extends Event
    {
        private $em;
        private $clinic;

        public function __construct($em, $clinic){

            $this->em = $em;
            $this->clinic = $clinic;
        }
     
        public function setUp()
        {

            foreach($this->clinic->getPatients() as $patient){

                $patient->setFirstName(ucfirst($patient->getFirstName()));
                $patient->setLastName(ucfirst($patient->getLastName()));
                $this->em->persist($patient);
                $this->em->flush();
            }
        }
     
    }
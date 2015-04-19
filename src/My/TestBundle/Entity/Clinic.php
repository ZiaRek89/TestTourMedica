<?php

namespace My\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

/**
 * Clinic.
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Clinic
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="Patient", inversedBy="clinics", cascade={"persist"})
     */
    private $patients;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Clinic
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->patients = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add patients.
     *
     * @param \My\TestBundle\Entity\Patient $patients
     *
     * @return Clinic
     */
    public function addPatient(\My\TestBundle\Entity\Patient $patients)
    {
        $this->patients[] = $patients;

        return $this;
    }

    /**
     * Remove patients.
     *
     * @param \My\TestBundle\Entity\Patient $patients
     */
    public function removePatient(\My\TestBundle\Entity\Patient $patients)
    {
        $this->patients->removeElement($patients);
    }

    /**
     * Get patients.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPatients()
    {
        return $this->patients;
    }

    /**
     * @ORM\PostUpdate
     */
    public function postUpdate(LifecycleEventArgs $args)
    {
        $em = $args->getObjectManager();

        foreach ($this->getPatients() as $patient) {
            $patient->setFirstName(ucfirst($patient->getFirstName()));
            $patient->setLastName(ucfirst($patient->getLastName()));

            $em->persist($patient);
            $em->flush();
        }
    }
}

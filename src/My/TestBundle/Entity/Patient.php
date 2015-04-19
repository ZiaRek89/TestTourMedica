<?php

namespace My\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use My\TestBundle\Validator\Constraints as Assert;

/**
 * Patient.
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Patient
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
     * @ORM\Column(name="firstName", type="string", length=255)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=255)
     */
    private $lastName;

    /**
     * @var bigint
     *
     * @Assert\PESEL
     * @ORM\Column(name="pesel", type="bigint")
     */
    private $pesel;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateBirth", type="date")
     */
    private $dateBirth;

    /**
     * @ORM\ManyToMany(targetEntity="Clinic", mappedBy="patients")
     */
    private $clinics;

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
     * Set firstName.
     *
     * @param string $firstName
     *
     * @return Patient
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName.
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName.
     *
     * @param string $lastName
     *
     * @return Patient
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName.
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set pesel.
     *
     * @param int $pesel
     *
     * @return Patient
     */
    public function setPesel($pesel)
    {
        $this->pesel = $pesel;

        return $this;
    }

    /**
     * Get pesel.
     *
     * @return int
     */
    public function getPesel()
    {
        return $this->pesel;
    }

    /**
     * Set dateBirth.
     *
     * @param \DateTime $dateBirth
     *
     * @return Patient
     */
    public function setDateBirth($dateBirth)
    {
        $this->dateBirth = $dateBirth;

        return $this;
    }

    /**
     * Get dateBirth.
     *
     * @return \DateTime
     */
    public function getDateBirth()
    {
        return $this->dateBirth;
    }
    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->clinics = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add clinics.
     *
     * @param \My\TestBundle\Entity\Clinic $clinics
     *
     * @return Patient
     */
    public function addClinic(\My\TestBundle\Entity\Clinic $clinics)
    {
        $this->clinics[] = $clinics;

        return $this;
    }

    /**
     * Remove clinics.
     *
     * @param \My\TestBundle\Entity\Clinic $clinics
     */
    public function removeClinic(\My\TestBundle\Entity\Clinic $clinics)
    {
        $this->clinics->removeElement($clinics);
    }

    /**
     * Get clinics.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClinics()
    {
        return $this->clinics;
    }
}

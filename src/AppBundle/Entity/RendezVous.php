<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * rendezVous
 *
 * @ORM\Table(name="rendez_vous")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RendezVousRepository")
 */
class RendezVous
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="reference", type="string", length=255, unique=true)
     */
    private $reference;

    /**
     * @var bool
     *
     * @ORM\Column(name="isComing", type="boolean")
     */
    private $isComing;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return rendezVous
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set reference
     *
     * @param string $reference
     * @return rendezVous
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return string 
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set isComing
     *
     * @param boolean $isComing
     * @return rendezVous
     */
    public function setIsComing($isComing)
    {
        $this->isComing = $isComing;

        return $this;
    }

    /**
     * Get isComing
     *
     * @return boolean 
     */
    public function getIsComing()
    {
        return $this->isComing;
    }
}

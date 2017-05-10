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
    private $isComing = false;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Client", inversedBy="rendezVous")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     */
    private $client;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Maladie", inversedBy="rendezVouses")
     * @ORM\JoinColumn(name="maladie_id", referencedColumnName="id")
     */
    private $maladie;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Docteur", inversedBy="rdvs")
     * @ORM\JoinColumn(name="docteur_id", referencedColumnName="id")
     */
    private $docteur;

    public function __construct()
    {
        $this->reference = bin2hex(random_bytes(14));
    }

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

    /**
     * Set client
     *
     * @param \AppBundle\Entity\Client $client
     *
     * @return RendezVous
     */
    public function setClient(\AppBundle\Entity\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \AppBundle\Entity\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set docteur
     *
     * @param \AppBundle\Entity\Docteur $docteur
     *
     * @return RendezVous
     */
    public function setDocteur(\AppBundle\Entity\Docteur $docteur = null)
    {
        $this->docteur = $docteur;

        return $this;
    }

    /**
     * Get docteur
     *
     * @return \AppBundle\Entity\Docteur
     */
    public function getDocteur()
    {
        return $this->docteur;
    }

    /**
     * Set maladie
     *
     * @param \AppBundle\Entity\Maladie $maladie
     *
     * @return RendezVous
     */
    public function setMaladie(\AppBundle\Entity\Maladie $maladie = null)
    {
        $this->maladie = $maladie;

        return $this;
    }

    /**
     * Get maladie
     *
     * @return \AppBundle\Entity\Maladie
     */
    public function getMaladie()
    {
        return $this->maladie;
    }
}

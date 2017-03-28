<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Client
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="client")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ClientRepository")
 */
class Client
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="couleur", type="string", length=255)
     */
    private $couleur;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="date")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Espece", inversedBy="clients")
     * @ORM\JoinColumn(name="espece_id", referencedColumnName="id")
     */
    private $espece;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\RendezVous", mappedBy="client")
     */
    private $rendezVous;

    public function __construct() {
        $this->rendezVous = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getNom().' '.$this->getEspece();
    }

    /**
     * @return mixed
     */
    public function getEspece()
    {
        return $this->espece;
    }

    /**
     * @param mixed $espece
     * @return Client
     */
    public function setEspece($espece)
    {
        $this->espece = $espece;
        return $this;
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
     * Set nom
     *
     * @param string $nom
     * @return Client
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set couleur
     *
     * @param string $couleur
     * @return Client
     */
    public function setCouleur($couleur)
    {
        $this->couleur = $couleur;

        return $this;
    }

    /**
     * Get couleur
     *
     * @return string 
     */
    public function getCouleur()
    {
        return $this->couleur;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Client
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * Add rendezVous
     *
     * @param \AppBundle\Entity\RendezVous $rendezVous
     *
     * @return Client
     */
    public function addRendezVous(\AppBundle\Entity\RendezVous $rendezVous)
    {
        $this->rendezVous[] = $rendezVous;

        return $this;
    }

    /**
     * Remove rendezVous
     *
     * @param \AppBundle\Entity\RendezVous $rendezVous
     */
    public function removeRendezVous(\AppBundle\Entity\RendezVous $rendezVous)
    {
        $this->rendezVous->removeElement($rendezVous);
    }

    /**
     * Get rendezVous
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRendezVous()
    {
        return $this->rendezVous;
    }
}

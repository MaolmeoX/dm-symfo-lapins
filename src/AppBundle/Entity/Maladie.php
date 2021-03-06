<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Maladie
 *
 * @ORM\Table(name="maladie")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MaladieRepository")
 */
class Maladie
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
     * @ORM\Column(name="nom", type="string", length=255, unique=true)
     */
    private $nom;

    /**
     * @Assert\Type(type="AppBundle\Entity\Traitement")
     * @Assert\Valid()
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Traitement", mappedBy="maladie", cascade={"persist"})
     */
    private $traitement;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Espece", inversedBy="maladies")
     * @ORM\JoinTable(name="maladies_especes")
     */
    private $especes;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\RendezVous", mappedBy="maladie")
     */
    private $rendezVouses;

    public function __construct() {
        $this->especes = new ArrayCollection();
        $this->rendezVouses = new ArrayCollection();
    }

    function __toString()
    {
       return $this->getNom();
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
     * @return Maladie
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
     * Add espece
     *
     * @param \AppBundle\Entity\Espece $espece
     *
     * @return Maladie
     */
    public function addEspece(\AppBundle\Entity\Espece $espece)
    {
        $this->especes[] = $espece;

        return $this;
    }

    /**
     * Remove espece
     *
     * @param \AppBundle\Entity\Espece $espece
     */
    public function removeEspece(\AppBundle\Entity\Espece $espece)
    {
        $this->especes->removeElement($espece);
    }

    /**
     * Get especes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEspeces()
    {
        return $this->especes;
    }

    /**
     * Set traitement
     *
     * @param \AppBundle\Entity\Traitement $traitement
     *
     * @return Maladie
     */
    public function setTraitement(\AppBundle\Entity\Traitement $traitement = null)
    {
        $this->traitement = $traitement;
        $traitement->setMaladie($this);

        return $this;
    }

    /**
     * Get traitement
     *
     * @return \AppBundle\Entity\Traitement
     */
    public function getTraitement()
    {
        return $this->traitement;
    }

    /**
     * Add rendezVouse
     *
     * @param \AppBundle\Entity\RendezVous $rendezVouse
     *
     * @return Maladie
     */
    public function addRendezVouse(\AppBundle\Entity\RendezVous $rendezVouse)
    {
        $this->rendezVouses[] = $rendezVouse;

        return $this;
    }

    /**
     * Remove rendezVouse
     *
     * @param \AppBundle\Entity\RendezVous $rendezVouse
     */
    public function removeRendezVouse(\AppBundle\Entity\RendezVous $rendezVouse)
    {
        $this->rendezVouses->removeElement($rendezVouse);
    }

    /**
     * Get rendezVouses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRendezVouses()
    {
        return $this->rendezVouses;
    }
}

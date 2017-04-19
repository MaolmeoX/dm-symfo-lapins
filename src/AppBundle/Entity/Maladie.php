<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Traitement", mappedBy="maladie")
     */
    private $traitement;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Espece", inversedBy="maladies")
     * @ORM\JoinTable(name="maladies_especes")
     */
    private $especes;

    public function __construct() {
        $this->especes = new ArrayCollection();
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
}

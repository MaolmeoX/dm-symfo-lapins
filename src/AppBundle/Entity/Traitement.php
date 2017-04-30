<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Traitement
 *
 * @ORM\Table(name="traitement")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TraitementRepository")
 */
class Traitement
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
     * One Cart has One Customer.
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Maladie", inversedBy="traitement", cascade={"persist"})
     * @ORM\JoinColumn(name="maladie_id", referencedColumnName="id")
     */
    private $maladie;

    function __toString()
    {
        return $this->getNom();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Traitement
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
     * Set maladie
     *
     * @param \AppBundle\Entity\Maladie $maladie
     *
     * @return Traitement
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

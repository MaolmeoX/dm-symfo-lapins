<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Docteur
 *
 * @ORM\Table(name="docteur")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DocteurRepository")
 */
class Docteur
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
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Espece", inversedBy="docteurs")
     * @ORM\JoinTable(name="docteurs_especes")
     */
    private $especes;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\RendezVous", mappedBy="docteur")
     */
    private $rdvs;

    public function __construct()
    {
        $this->especes = new ArrayCollection();
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
     * @return Docteur
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
     * Set prenom
     *
     * @param string $prenom
     * @return Docteur
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Add espece
     *
     * @param \AppBundle\Entity\Espece $espece
     *
     * @return Docteur
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
     * Add rdv
     *
     * @param \AppBundle\Entity\RendezVous $rdv
     *
     * @return Docteur
     */
    public function addRdv(\AppBundle\Entity\RendezVous $rdv)
    {
        $this->rdvs[] = $rdv;

        return $this;
    }

    /**
     * Remove rdv
     *
     * @param \AppBundle\Entity\RendezVous $rdv
     */
    public function removeRdv(\AppBundle\Entity\RendezVous $rdv)
    {
        $this->rdvs->removeElement($rdv);
    }

    /**
     * Get rdvs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRdvs()
    {
        return $this->rdvs;
    }
}

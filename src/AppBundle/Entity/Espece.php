<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Espece
 *
 * @ORM\Table(name="espece")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EspeceRepository")
 */
class Espece
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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Client", mappedBy="espece")
     */
    private $clients;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Maladie", mappedBy="especes")
     */
    private $maladies;

    /**
     * @var
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Docteur", mappedBy="especes")
     */
    private $docteurs;

    public function __construct() {
        $this->clients = new ArrayCollection();
        $this->maladies = new ArrayCollection();
        $this->docteurs = new ArrayCollection();
    }

    public function __toString()
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
     * @return Espece
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
     * Add client
     *
     * @param \AppBundle\Entity\Client $client
     *
     * @return Espece
     */
    public function addClient(\AppBundle\Entity\Client $client)
    {
        $this->clients[] = $client;

        return $this;
    }

    /**
     * Remove client
     *
     * @param \AppBundle\Entity\Client $client
     */
    public function removeClient(\AppBundle\Entity\Client $client)
    {
        $this->clients->removeElement($client);
    }

    /**
     * Get clients
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClients()
    {
        return $this->clients;
    }

    /**
     * Add malady
     *
     * @param \AppBundle\Entity\Maladie $malady
     *
     * @return Espece
     */
    public function addMalady(\AppBundle\Entity\Maladie $malady)
    {
        $this->maladies[] = $malady;

        return $this;
    }

    /**
     * Remove malady
     *
     * @param \AppBundle\Entity\Maladie $malady
     */
    public function removeMalady(\AppBundle\Entity\Maladie $malady)
    {
        $this->maladies->removeElement($malady);
    }

    /**
     * Get maladies
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMaladies()
    {
        return $this->maladies;
    }

    /**
     * Add docteur
     *
     * @param \AppBundle\Entity\Docteur $docteur
     *
     * @return Espece
     */
    public function addDocteur(\AppBundle\Entity\Docteur $docteur)
    {
        $this->docteurs[] = $docteur;

        return $this;
    }

    /**
     * Remove docteur
     *
     * @param \AppBundle\Entity\Docteur $docteur
     */
    public function removeDocteur(\AppBundle\Entity\Docteur $docteur)
    {
        $this->docteurs->removeElement($docteur);
    }

    /**
     * Get docteurs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDocteurs()
    {
        return $this->docteurs;
    }
}

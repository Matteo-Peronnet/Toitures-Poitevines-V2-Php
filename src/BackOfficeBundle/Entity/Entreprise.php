<?php

namespace BackOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entreprise
 *
 * @ORM\Table(name="entreprise")
 * @ORM\Entity(repositoryClass="BackOfficeBundle\Repository\EntrepriseRepository")
 */
class Entreprise
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
     * @ORM\Column(name="siege", type="string", length=255)
     */
    private $siege;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=255)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="coGerants", type="string", length=255)
     */
    private $coGerants;

    /**
     * @var string
     *
     * @ORM\Column(name="sarl", type="string", length=255)
     */
    private $sarl;

    /**
     * @var string
     *
     * @ORM\Column(name="siret", type="string", length=255)
     */
    private $siret;

    /**
     * @var string
     *
     * @ORM\Column(name="tva", type="string", length=255)
     */
    private $tva;

    /**
     * @var Devis
     * @ORM\OneToMany(targetEntity="BackOfficeBundle\Entity\Devis", cascade={"persist"},mappedBy="entreprise")
     */
    private $devis;


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
     * @return Entreprise
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
     * Set siege
     *
     * @param string $siege
     *
     * @return Entreprise
     */
    public function setSiege($siege)
    {
        $this->siege = $siege;

        return $this;
    }

    /**
     * Get siege
     *
     * @return string
     */
    public function getSiege()
    {
        return $this->siege;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return Entreprise
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set coGerants
     *
     * @param string $coGerants
     *
     * @return Entreprise
     */
    public function setCoGerants($coGerants)
    {
        $this->coGerants = $coGerants;

        return $this;
    }

    /**
     * Get coGerants
     *
     * @return string
     */
    public function getCoGerants()
    {
        return $this->coGerants;
    }

    /**
     * Set sarl
     *
     * @param string $sarl
     *
     * @return Entreprise
     */
    public function setSarl($sarl)
    {
        $this->sarl = $sarl;

        return $this;
    }

    /**
     * Get sarl
     *
     * @return string
     */
    public function getSarl()
    {
        return $this->sarl;
    }

    /**
     * Set siret
     *
     * @param string $siret
     *
     * @return Entreprise
     */
    public function setSiret($siret)
    {
        $this->siret = $siret;

        return $this;
    }

    /**
     * Get siret
     *
     * @return string
     */
    public function getSiret()
    {
        return $this->siret;
    }

    /**
     * Set tva
     *
     * @param string $tva
     *
     * @return Entreprise
     */
    public function setTva($tva)
    {
        $this->tva = $tva;

        return $this;
    }

    /**
     * Get tva
     *
     * @return string
     */
    public function getTva()
    {
        return $this->tva;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->devis = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add devi
     *
     * @param \BackOfficeBundle\Entity\Devis $devi
     *
     * @return Entreprise
     */
    public function addDevi(\BackOfficeBundle\Entity\Devis $devi)
    {
        $this->devis[] = $devi;

        return $this;
    }

    /**
     * Remove devi
     *
     * @param \BackOfficeBundle\Entity\Devis $devi
     */
    public function removeDevi(\BackOfficeBundle\Entity\Devis $devi)
    {
        $this->devis->removeElement($devi);
    }

    /**
     * Get devis
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDevis()
    {
        return $this->devis;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param Devis $devis
     */
    public function setDevis($devis)
    {
        $this->devis = $devis;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

}

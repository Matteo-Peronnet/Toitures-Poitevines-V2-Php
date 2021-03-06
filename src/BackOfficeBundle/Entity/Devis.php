<?php

namespace BackOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Devis
 *
 * @ORM\Table(name="devis")
 * @ORM\Entity(repositoryClass="BackOfficeBundle\Repository\DevisRepository")
 */
class Devis
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
     * @var int
     *
     * @ORM\Column(name="numero", type="integer", unique=false, nullable=true)
     */
    private $numero;

    /**
     * @var float
     *
     * @ORM\Column(name="prixHT", type="float", nullable=true)
     */
    private $prixHT =0;

    /**
     * @var float
     *
     * @ORM\Column(name="prixTTC", type="float", nullable=true)
     */
    private $prixTTC =0;

    /**
     * @var float
     *
     * @ORM\Column(name="tva", type="float", nullable=true)
     */
    private $tva;

    /**
     * @var text
     *
     * @ORM\Column(name="information", type="text", nullable=true)
     */
    private $information;



    /**
     * @var string
     *
     * @ORM\Column(name="chantier", type="string", length=255, nullable=true)
     */
    private $chantier;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date", type="datetime", nullable=true)
     */
    private $date;

    /**
     * @var boolean
     *
     * @ORM\Column(name="brouillon", type="boolean", nullable=true)
     */
    private $brouillon;

    /**
     * @var LigneDevis
     * @ORM\OneToMany(targetEntity="BackOfficeBundle\Entity\LigneDevis", cascade={"remove"},mappedBy="devis")
     */
    private $ligneDevis;

    /**
     * @var Client
     * @ORM\ManyToOne(targetEntity="BackOfficeBundle\Entity\Client", cascade={"persist"},inversedBy="devis")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id", nullable=true)
     */
    private $client;

    /**
     * @var Entreprise
     * @ORM\ManyToOne(targetEntity="BackOfficeBundle\Entity\Entreprise", cascade={"persist"},inversedBy="devis")
     * @ORM\JoinColumn(name="entreprise_id", referencedColumnName="id", nullable=true)
     */
    private $entreprise;

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
     * Set numero
     *
     * @param integer $numero
     *
     * @return Devis
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return int
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set prixHT
     *
     * @param float $prixHT
     *
     * @return Devis
     */
    public function setPrixHT($prixHT)
    {
        $this->prixHT = $prixHT;

        return $this;
    }

    /**
     * Get prixHT
     *
     * @return float
     */
    public function getPrixHT()
    {
        return $this->prixHT;
    }

    /**
     * Set prixTTC
     *
     * @param float $prixTTC
     *
     * @return Devis
     */
    public function setPrixTTC($prixTTC)
    {
        $this->prixTTC = $prixTTC;

        return $this;
    }

    /**
     * Get prixTTC
     *
     * @return float
     */
    public function getPrixTTC()
    {
        return $this->prixTTC;
    }

    /**
     * Set chantier
     *
     * @param string $chantier
     *
     * @return Devis
     */
    public function setChantier($chantier)
    {
        $this->chantier = $chantier;

        return $this;
    }

    /**
     * Get chantier
     *
     * @return string
     */
    public function getChantier()
    {
        return $this->chantier;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ligneDevis = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Devis
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
     * @return text
     */
    public function getInformation()
    {
        return $this->information;
    }

    /**
     * @return float
     */
    public function getTva()
    {
        return $this->tva;
    }

    /**
     * @param float $tva
     */
    public function setTva($tva)
    {
        $this->tva = $tva;
    }

    /**
     * @param text $information
     */
    public function setInformation($information)
    {
        $this->information = $information;
    }

    /**
     * Add ligneDevi
     *
     * @param \BackOfficeBundle\Entity\LigneDevis $ligneDevi
     *
     * @return Devis
     */
    public function addLigneDevi(\BackOfficeBundle\Entity\LigneDevis $ligneDevi)
    {
        $this->ligneDevis[] = $ligneDevi;

        return $this;
    }

    /**
     * Remove ligneDevi
     *
     * @param \BackOfficeBundle\Entity\LigneDevis $ligneDevi
     */
    public function removeLigneDevi(\BackOfficeBundle\Entity\LigneDevis $ligneDevi)
    {
        $this->ligneDevis->removeElement($ligneDevi);
    }

    /**
     * Get ligneDevis
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLigneDevis()
    {
        return $this->ligneDevis;
    }

    /**
     * Set client
     *
     * @param \BackOfficeBundle\Entity\Client $client
     *
     * @return Devis
     */
    public function setClient(\BackOfficeBundle\Entity\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \BackOfficeBundle\Entity\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set entreprise
     *
     * @param \BackOfficeBundle\Entity\Entreprise $entreprise
     *
     * @return Devis
     */
    public function setEntreprise(\BackOfficeBundle\Entity\Entreprise $entreprise)
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    /**
     * Get entreprise
     *
     * @return \BackOfficeBundle\Entity\Entreprise
     */
    public function getEntreprise()
    {
        return $this->entreprise;
    }

    /**
     * @param boolean $brouillon
     */
    public function setBrouillon($brouillon)
    {
        $this->brouillon = $brouillon;
    }

    /**
     * @return boolean
     */
    public function isBrouillon()
    {
        return $this->brouillon;
    }
}

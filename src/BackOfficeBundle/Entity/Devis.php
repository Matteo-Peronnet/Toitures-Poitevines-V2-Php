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
     * @ORM\Column(name="numero", type="integer", unique=true)
     */
    private $numero;

    /**
     * @var float
     *
     * @ORM\Column(name="prixHT", type="float")
     */
    private $prixHT;

    /**
     * @var float
     *
     * @ORM\Column(name="prixTTC", type="float")
     */
    private $prixTTC;

    /**
     * @var string
     *
     * @ORM\Column(name="chantier", type="string", length=255)
     */
    private $chantier;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date", type="datetime")
     */
    private $date;

    /**
     * @var LigneDevis
     * @ORM\OneToMany(targetEntity="BackOfficeBundle\Entity\LigneDevis", cascade={"persist"},mappedBy="devis")
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
     * @ORM\JoinColumn(name="entreprise_id", referencedColumnName="id", nullable=false)
     */
    private $entreprise;

    /**
     * @var SettingsDevis
     * @ORM\ManyToOne(targetEntity="BackOfficeBundle\Entity\SettingsDevis", cascade={"persist"},inversedBy="devis")
     * @ORM\JoinColumn(name="settingsDevis_id", referencedColumnName="id", nullable=false)
     */
    private $settingsDevis;

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
     * Set settingsDevis
     *
     * @param \BackOfficeBundle\Entity\SettingsDevis $settingsDevis
     *
     * @return Devis
     */
    public function setSettingsDevis(\BackOfficeBundle\Entity\SettingsDevis $settingsDevis)
    {
        $this->settingsDevis = $settingsDevis;

        return $this;
    }

    /**
     * Get settingsDevis
     *
     * @return \BackOfficeBundle\Entity\SettingsDevis
     */
    public function getSettingsDevis()
    {
        return $this->settingsDevis;
    }
}

<?php

namespace BackOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SettingsDevis
 *
 * @ORM\Table(name="settings_devis")
 * @ORM\Entity(repositoryClass="BackOfficeBundle\Repository\SettingsDevisRepository")
 */
class SettingsDevis
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
     * @ORM\Column(name="information", type="text")
     */
    private $information;

    /**
     * @var float
     *
     * @ORM\Column(name="tva", type="float")
     */
    private $tva;


    /**
     * @var Devis
     * @ORM\OneToMany(targetEntity="BackOfficeBundle\Entity\Devis", cascade={"persist"},mappedBy="settingsDevis")
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
     * Set information
     *
     * @param string $information
     *
     * @return SettingsDevis
     */
    public function setInformation($information)
    {
        $this->information = $information;

        return $this;
    }

    /**
     * Get information
     *
     * @return string
     */
    public function getInformation()
    {
        return $this->information;
    }

    /**
     * Set tva
     *
     * @param float $tva
     *
     * @return SettingsDevis
     */
    public function setTva($tva)
    {
        $this->tva = $tva;

        return $this;
    }

    /**
     * Get tva
     *
     * @return float
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
     * @return SettingsDevis
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
}

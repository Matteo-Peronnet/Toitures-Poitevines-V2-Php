<?php

namespace BackOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LigneDevis
 *
 * @ORM\Table(name="ligne_devis")
 * @ORM\Entity(repositoryClass="BackOfficeBundle\Repository\LigneDevisRepository")
 */
class LigneDevis
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
     * @var float
     *
     * @ORM\Column(name="quantite", type="float")
     */
    private $quantite;

    /**
     * @var float
     *
     * @ORM\Column(name="pvtHT", type="float")
     */
    private $pvtHT;

    /**
     * @var Produit
     * @ORM\ManyToOne(targetEntity="BackOfficeBundle\Entity\Produit", cascade={"persist"},inversedBy="ligneDevis")
     * @ORM\JoinColumn(name="produit_id", referencedColumnName="id", nullable=false)
     */
    private $produit;

    /**
     * @var Devis
     * @ORM\ManyToOne(targetEntity="BackOfficeBundle\Entity\Devis", cascade={"persist"},inversedBy="ligneDevis")
     * @ORM\JoinColumn(name="devis_id", referencedColumnName="id", nullable=false)
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
     * Set quantite
     *
     * @param float $quantite
     *
     * @return LigneDevis
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return float
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set pvtHT
     *
     * @param float $pvtHT
     *
     * @return LigneDevis
     */
    public function setPvtHT($pvtHT)
    {
        $this->pvtHT = $pvtHT;

        return $this;
    }

    /**
     * Get pvtHT
     *
     * @return float
     */
    public function getPvtHT()
    {
        return $this->pvtHT;
    }

    /**
     * Set produit
     *
     * @param \BackOfficeBundle\Entity\Produit $produit
     *
     * @return LigneDevis
     */
    public function setProduit(\BackOfficeBundle\Entity\Produit $produit)
    {
        $this->produit = $produit;

        return $this;
    }

    /**
     * Get produit
     *
     * @return \BackOfficeBundle\Entity\Produit
     */
    public function getProduit()
    {
        return $this->produit;
    }

    /**
     * Set devis
     *
     * @param \BackOfficeBundle\Entity\Devis $devis
     *
     * @return LigneDevis
     */
    public function setDevis(\BackOfficeBundle\Entity\Devis $devis)
    {
        $this->devis = $devis;

        return $this;
    }

    /**
     * Get devis
     *
     * @return \BackOfficeBundle\Entity\Devis
     */
    public function getDevis()
    {
        return $this->devis;
    }
}

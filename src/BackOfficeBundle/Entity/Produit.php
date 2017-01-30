<?php

namespace BackOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table(name="produit")
 * @ORM\Entity(repositoryClass="BackOfficeBundle\Repository\ProduitRepository")
 */
class Produit
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
     * @ORM\Column(name="unite", type="string", length=255)
     */
    private $unite;


    /**
     * @var integer
     *
     * @ORM\Column(name="prixHT", type="integer")
     */
    private $prixHT;

    /**
     * @var LigneDevis
     * @ORM\OneToMany(targetEntity="BackOfficeBundle\Entity\LigneDevis", cascade={"persist"},mappedBy="produit")
     */
    private $ligneDevis;

    /**
     * @var Categorie
     * @ORM\ManyToOne(targetEntity="BackOfficeBundle\Entity\Categorie", cascade={"persist"},inversedBy="produit")
     * @ORM\JoinColumn(name="categorie_id", referencedColumnName="id", nullable=false)
     */
    private $categorie;




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
     * @return Produit
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
     * Set prixHT
     *
     * @param string $prixHT
     *
     * @return Produit
     */
    public function setPrixHT($prixHT)
    {
        $this->prixHT = $prixHT;

        return $this;
    }

    /**
     * Get prixHT
     *
     * @return string
     */
    public function getPrixHT()
    {
        return $this->prixHT;
    }

    /**
     * @return string
     */
    public function getUnite()
    {
        return $this->unite;
    }

    /**
     * @param string $unite
     */
    public function setUnite($unite)
    {
        $this->unite = $unite;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ligneDevis = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add ligneDevi
     *
     * @param \BackOfficeBundle\Entity\LigneDevis $ligneDevi
     *
     * @return Produit
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
     * Set categorie
     *
     * @param \BackOfficeBundle\Entity\Categorie $categorie
     *
     * @return Produit
     */
    public function setCategorie(\BackOfficeBundle\Entity\Categorie $categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \BackOfficeBundle\Entity\Categorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }
}

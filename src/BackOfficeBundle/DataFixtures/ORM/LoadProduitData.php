<?php

namespace BackOfficeBundle\DataFixtures\ORM;

use BackOfficeBundle\Entity\Produit;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadProduitData extends AbstractFixture implements OrderedFixtureInterface{

    public function load(ObjectManager $manager)
    {
        if (($handle = fopen("web/produits.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                $categorie = $manager->getRepository('BackOfficeBundle:Categorie')->findOneBy(array('nom'=>($data[0])));
                $produit = new Produit();
                $produit->setNom($data[1]);
                $produit->setUnite($data[2]);
                $produit->setPrixHT(floatval($data[3]));
                $produit->setCategorie($categorie);
                $manager->persist($produit);
            }
            fclose($handle);
        }else{
            echo "Fichier non trouvé";
        }
        $manager->flush();
    }
    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 2;
    }
}
<?php

namespace BackOfficeBundle\DataFixtures\ORM;

use BackOfficeBundle\Entity\Categorie;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCategorieData extends AbstractFixture implements OrderedFixtureInterface{

    public function load(ObjectManager $manager)
    {
        $CouvertureArdoise = new Categorie();
        $CouvertureArdoise->setNom("Couverture Ardoise");
        $CouvertureArdoise->setPlacement(1);
        $manager->persist($CouvertureArdoise);

        $CouvertureTuile = new Categorie();
        $CouvertureTuile->setNom("Couverture Tuile");
        $CouvertureTuile->setPlacement(2);
        $manager->persist($CouvertureTuile);

        $Demoussage = new Categorie();
        $Demoussage->setNom("Demoussage");
        $Demoussage->setPlacement(3);
        $manager->persist($Demoussage);

        $EquipementDeChantier = new Categorie();
        $EquipementDeChantier->setNom("Equipement de chantier");
        $EquipementDeChantier->setPlacement(4);
        $manager->persist($EquipementDeChantier);

        $Velux = new Categorie();
        $Velux->setNom("Velux");
        $Velux->setPlacement(5);
        $manager->persist($Velux);

        $Zinguerie = new Categorie();
        $Zinguerie->setNom("Zinguerie");
        $Zinguerie->setPlacement(6);
        $manager->persist($Zinguerie);

        $Couverture = new Categorie();
        $Couverture->setNom("Couverture");
        $Couverture->setPlacement(7);
        $manager->persist($Couverture);

        $Plancher = new Categorie(8);
        $Plancher->setNom("Plancher");
        $Plancher->setPlacement(9);
        $manager->persist($Plancher);

        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 1;
    }
}
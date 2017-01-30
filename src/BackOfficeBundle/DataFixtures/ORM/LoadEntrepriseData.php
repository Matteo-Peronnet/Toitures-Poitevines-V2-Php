<?php

namespace BackOfficeBundle\DataFixtures\ORM;

use BackOfficeBundle\Entity\Entreprise;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadEntrepriseData extends AbstractFixture implements OrderedFixtureInterface{

    public function load(ObjectManager $manager)
    {
        $toituresPoitevine = new Entreprise();
        $toituresPoitevine->setNom("Toitures Poitevines");
        $toituresPoitevine->setCoGerants("Pascal JOUSSEAUME - Fabrice TRABLEAU");
        $toituresPoitevine->setSarl("SARL au capital de 10000€");
        $toituresPoitevine->setSiret("SIRET 484 494 570 000 27 APE 4391 A ");
        $toituresPoitevine->setTva("TVA FR 264 844 945 70");
        $toituresPoitevine->setSiege("10 allée René Caillié 86 000 POITIERS");
        $toituresPoitevine->setTelephone("05.49.11.94.42 ou 06.72.42.55.92");

        $manager->persist($toituresPoitevine);
        $manager->flush();
    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 3;
    }
}
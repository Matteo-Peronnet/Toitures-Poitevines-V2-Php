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
        $toituresPoitevine->setCoGerants("Pxxxx Jxxxxxxx - Fxxxxxxx Txxxxxx");
        $toituresPoitevine->setSarl("SARL au capital de xxxxxxx€");
        $toituresPoitevine->setSiret("SIRET xxx xxx xxx xxx xx APE xxxx x");
        $toituresPoitevine->setTva("TVA FR xxx xxx xxx xx");
        $toituresPoitevine->setSiege("xx allée xxxx Xxxx XX XXX XXXXXX");
        $toituresPoitevine->setTelephone("xx.xx.xx.xx.xx ou xx.xx.xx.xx.xx");
        $toituresPoitevine->setEmail("testemail@yopmail.com");

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
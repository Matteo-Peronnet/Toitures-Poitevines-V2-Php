<?php

namespace BackOfficeBundle\DataFixtures\ORM;

use BackOfficeBundle\Entity\Entreprise;
use BackOfficeBundle\Entity\SettingsDevis;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadSettingsDevisData extends AbstractFixture implements OrderedFixtureInterface{

    public function load(ObjectManager $manager)
    {
        $settingsDevis = new SettingsDevis();
        $settingsDevis->setTva(20.0);
        $settingsDevis->setInformation("Sans l'attestation de TVA à 10% renvoyée remplie et signée, les traveaux seront facturés à 20% Nos prix sont établis sur la base des taux de TVA en vigueur à la date de la remise de l'offre Toute variationultérieur de ces taux, imposés par la loi, sera répercutée sur ces prix *Fait en double exemplaire *Date des travaux a déterminer avec le client *Date de validité du devis : 3 mois *Acompte 30% si accord *Solde en fin de chantier *Attestation décennale : MMA, n°140784594R Exemplaire à renvoyer signé si accord");

        $manager->persist($settingsDevis);
        $manager->flush();
    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 4;
    }
}
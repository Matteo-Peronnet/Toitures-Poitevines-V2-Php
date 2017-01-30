<?php

namespace BackOfficeBundle\Controller;

use BackOfficeBundle\Entity\Devis;
use BackOfficeBundle\Form\DevisType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

class DevisController extends Controller
{
    /**
     * @Route("devis/new",name="devis_new")
     * @Method({"POST","GET"})
     */
    public function newDevisAction(Request $request)
    {
        $devis = new Devis();
        $devis->setDate(new \DateTime());
        $devis->setInformation("Sans l'attestation de TVA à 10% renvoyée remplie et signée, les traveaux seront facturés à 20% Nos prix sont établis sur la base des taux de TVA en vigueur à la date de la remise de l'offre Toute variationultérieur de ces taux, imposés par la loi, sera répercutée sur ces prix *Fait en double exemplaire *Date des travaux a déterminer avec le client *Date de validité du devis : 3 mois *Acompte 30% si accord *Solde en fin de chantier *Attestation décennale : MMA, n°140784594R Exemplaire à renvoyer signé si accord");
        $form_devis = $this->createForm(DevisType::class,$devis);
        $form_devis->handleRequest($request);
        if($form_devis->isSubmitted()&& $form_devis->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($devis);
            $em->flush();
            //return $this->redirectToRoute('categorie_index');
        }

        return $this->render('BackOfficeBundle:Devis:newDevis.html.twig',array(
            'devis'=>$devis,
            'form_devis'=>$form_devis->createView()
        ));
    }
}

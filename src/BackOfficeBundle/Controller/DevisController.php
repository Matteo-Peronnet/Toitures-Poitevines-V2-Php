<?php

namespace BackOfficeBundle\Controller;

use BackOfficeBundle\Entity\Devis;
use BackOfficeBundle\Entity\LigneDevis;
use BackOfficeBundle\Form\DevisType;
use BackOfficeBundle\Form\LigneDevisType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncode;

class DevisController extends Controller
{
    /**
     * @Route("devis/new",name="devis_new")
     * @Method({"POST","GET"})
     */
    public function newDevisAction(Request $request)
    {
        // CREATION DEVIS BROUILLON
        $em = $this->getDoctrine()->getManager();
        $devis = new Devis();
        $devis->setDate(new \DateTime());
        $devis->setInformation("Sans l'attestation de TVA à 10% renvoyée remplie et signée, les traveaux seront facturés à 20% Nos prix sont établis sur la base des taux de TVA en vigueur à la date de la remise de l'offre Toute variationultérieur de ces taux, imposés par la loi, sera répercutée sur ces prix *Fait en double exemplaire *Date des travaux a déterminer avec le client *Date de validité du devis : 3 mois *Acompte 30% si accord *Solde en fin de chantier *Attestation décennale : MMA, n°140784594R Exemplaire à renvoyer signé si accord");
        $devis->setBrouillon(true);
        $em->persist($devis);
        $em->flush();

        $form_devis = $this->createForm(DevisType::class,$devis);
        $form_devis->handleRequest($request);
        if($form_devis->isSubmitted()&& $form_devis->isValid()) {
            //$em->persist($devis);
            //$em->flush();
            //return $this->redirectToRoute('');
        }

        // CREATION LIGNE DEVIS
        $form_ligne_devis = $this->createForm(LigneDevisType::class);

        return $this->render('BackOfficeBundle:Devis:newDevis.html.twig',array(
            'devis'=>$devis,
            'form_devis'=>$form_devis->createView(),
            'form_ligne_devis'=>$form_ligne_devis->createView()
        ));
    }

        /**
         * @Route("devis-ligne/new",name="devis_ligne_new")
         * @Method({"GET", "POST"})
         */

    public function addLigneDevis(Request $request){
        if($request->isXmlHttpRequest()){
            $em = $this->getDoctrine()->getManager();

            $idproduit = $request->request->get('idproduit');
            $quantite = $request->request->get('quantite');
            $iddevis = $request->request->get('iddevis');
            $tva = $request->request->get('tva');

            $produit = $this->getDoctrine()->getManager()->getRepository('BackOfficeBundle:Produit')->find($idproduit);
            $devis = $this->getDoctrine()->getManager()->getRepository('BackOfficeBundle:Devis')->find($iddevis);

            $ligne_devis = new LigneDevis();
            $ligne_devis->setQuantite($quantite);
            $ligne_devis->setDevis($devis);
            $ligne_devis->setProduit($produit);
            $ligne_devis->setPvtHT($produit->getPrixHT()*$quantite);
            $devis->setPrixHT($devis->getPrixHT()+$ligne_devis->getPvtHT());
            $devis->setTva($tva);
            $devis->setPrixTTC($devis->getPrixHT()+($devis->getPrixHT()*$devis->getTva()/100));

            $em->persist($ligne_devis);
            $em->persist($devis);
            $em->flush();

            $liste_ligne_devis = $this->getDoctrine()->getManager()->getRepository('BackOfficeBundle:LigneDevis')->findBy(array('devis'=>$devis));

            return new JsonResponse($liste_ligne_devis);
        }else{
            return new Response('This is not ajax!', 400);
        }
    }

    /**
     * @Route("/api/produit/add", name="api_get_produit")
     * @Method({"GET", "POST"})
     */
    public function getProduitAction(Request $request)
    {
        $categorie = $this->getDoctrine()->getRepository("BackOfficeBundle:Categorie")->find((int)$request->request->get("categorie_id"));
        $produit = $categorie->getProduit()->toArray();
        return new JsonResponse($produit);
    }

    /**
     * @Route("devis-ligne/delete",name="devis_ligne_delete")
     * @Method({"GET", "POST"})
     */

    public function deleteLigneDevis(Request $request){
        if($request->isXmlHttpRequest()){
            $em = $this->getDoctrine()->getManager();

            $idLigneDevis = $request->request->get('idLigneDevis');
            $iddevis = $request->request->get('iddevis');
            $tva = $request->request->get('tva');

            $ligne_devis = $this->getDoctrine()->getManager()->getRepository('BackOfficeBundle:LigneDevis')->find($idLigneDevis);
            $devis = $this->getDoctrine()->getManager()->getRepository('BackOfficeBundle:Devis')->find($iddevis);
            $devis->setPrixHT($devis->getPrixHT()-$ligne_devis->getPvtHT());

            $em->persist($devis);
            $em->remove($ligne_devis);
            $em->flush();

            $liste_ligne_devis = $this->getDoctrine()->getManager()->getRepository('BackOfficeBundle:LigneDevis')->findBy(array('devis'=>$devis));

            return new JsonResponse($liste_ligne_devis);
        }else{
            return new Response('This is not ajax!', 400);
        }
    }
}

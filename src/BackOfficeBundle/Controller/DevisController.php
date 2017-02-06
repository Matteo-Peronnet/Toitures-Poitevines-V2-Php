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
use Symfony\Component\Validator\Constraints\DateTime;

class DevisController extends Controller
{
    /**
     * @Route("devis/new",name="devis_new")
     * @Method("GET")
     */
    public function newDevisAction()
    {

        $repository_devis = $this->getDoctrine()->getManager()->getRepository('BackOfficeBundle:Devis');
        $numero_devis_max = $repository_devis->getMaxNumeroDevis();
        if($numero_devis_max[1]==null){
            $numero_devis_max=1;
        }else{
            $numero_devis_max = $numero_devis_max[1]+1;
        }

        // CREATION DEVIS BROUILLON
        $em = $this->getDoctrine()->getManager();
        $devis = new Devis();
        $devis->setDate(new \DateTime());
        $devis->setInformation("Sans l'attestation de TVA à 10% renvoyée remplie et signée, les traveaux seront facturés à 20% Nos prix sont établis sur la base des taux de TVA en vigueur à la date de la remise de l'offre Toute variationultérieur de ces taux, imposés par la loi, sera répercutée sur ces prix *Fait en double exemplaire *Date des travaux a déterminer avec le client *Date de validité du devis : 3 mois *Acompte 30% si accord *Solde en fin de chantier *Attestation décennale : MMA, n°140784594R Exemplaire à renvoyer signé si accord");
        $devis->setBrouillon(true);
        $em->persist($devis);
        $em->flush();
        $devis->setNumero($numero_devis_max);

        // CREATION Formulaire DEVIS
        $form_devis = $this->createForm(DevisType::class,$devis);

        // CREATION Formulaire Ligne_Devis
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
     * @Route("/api/get/client", name="api_get_client")
     * @Method({"GET", "POST"})
     */
    public function getChantierAction(Request $request)
    {
        $client = $this->getDoctrine()->getRepository("BackOfficeBundle:Client")->find((int)$request->request->get("client"));
        return new JsonResponse($client);
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
            $devis->setPrixTTC($devis->getPrixHT()+($devis->getPrixHT()*$devis->getTva()/100));

            $em->persist($devis);
            $em->remove($ligne_devis);
            $em->flush();

            $liste_ligne_devis = $this->getDoctrine()->getManager()->getRepository('BackOfficeBundle:LigneDevis')->findBy(array('devis'=>$devis));

            return new JsonResponse($liste_ligne_devis);
        }else{
            return new Response('This is not ajax!', 400);
        }
    }

    /**
     * @Route("devis/validate",name="devis_validate")
     * @Method({"GET", "POST"})
     */

    public function validateDevis(Request $request){

        if($request->isXmlHttpRequest()){
            $em = $this->getDoctrine()->getManager();

            $chantier = $request->request->get('chantier');
            $numero = $request->request->get('numero');
            $date = $request->request->get('date');
            $information = $request->request->get('information');
            $client = $request->request->get('client');
            $entreprise = $request->request->get('entreprise');
            $envoisecretaire = $request->request->get('envoisecretaire');
            $envoiclient = $request->request->get('envoiclient');
            $devis = $request->request->get('devis');
            $tva = $request->request->get('tva');


            $devis = $this->getDoctrine()->getManager()->getRepository('BackOfficeBundle:Devis')->find($devis);
            $devis->setChantier($chantier);
            $devis->setNumero($numero);
            $devis->setTva($tva);
            $devis->setClient($this->getDoctrine()->getManager()->getRepository('BackOfficeBundle:Client')->findBy(array('id'=>$client))[0]);
            $devis->setEntreprise($this->getDoctrine()->getManager()->getRepository('BackOfficeBundle:Entreprise')->findBy(array('id'=>$entreprise))[0]);
            $devis->setInformation($information);
            $devis->setDate(new \DateTime($date));
            $devis->setBrouillon(false);

            $em->persist($devis);
            $em->flush();
            return new JsonResponse("Good");
        }
    }

    /**
     * @Route("devis/generation/{id}",name="devis_generation")
     * @Method("GET")
     */
    public function generationDevisAction(Devis $devis)
    {
        $devis = $this->getDoctrine()->getManager()->getRepository('BackOfficeBundle:Devis')->find($devis);
        $ligne_devis = $this->getDoctrine()->getManager()->getRepository('BackOfficeBundle:LigneDevis')->getSortLigneDevisOfDevis($devis);

        $html = $this->renderView('BackOfficeBundle:Devis:generationDevis.html.twig',array(
            'devis'=>$devis,
            'ligne_devis'=>$ligne_devis
        ));
        $pdfFolder = __DIR__.'../../../../web/uploads/Devis/';
        if(file_exists($pdfFolder.'devis-'.$devis->getNumero().'.pdf')){
            unlink($pdfFolder.'devis-'.$devis->getNumero().'.pdf');
        }
        $this->get('knp_snappy.pdf')->generateFromHtml($html,$pdfFolder.'devis-'.$devis->getNumero().'.pdf');


        $this->get('knp_snappy.pdf')->getOutputFromHtml($html,array(
                'footer-font-size'=>10,
                'footer-left'=>utf8_decode('SARL au capital de 10000euros SIRET 484 494 570 000 27 APE 4391 A   TVA FR 264 844 945 70'),
                'footer-right'=>utf8_decode('Page [page] sur [topage]')
            ));
        return $this->redirectToRoute('index');

    }

    /**
     * @Route("devis/",name="devis_index")
     */
    public function indexProduitAction()
    {
        $repository_devis = $this->getDoctrine()->getManager()->getRepository('BackOfficeBundle:Devis');
        $devis = $repository_devis->findBy(['brouillon'=>false],['numero' => 'asc']);
        $deleteForms = [];
        foreach($devis as $leDevis){
            $deleteForms[$leDevis->getId()] = $this->createDeleteFormProduit($leDevis)->createView();
        }

        return $this->render('BackOfficeBundle:Devis:listeDevis.html.twig',array(
            'devis'=>$devis,
            'delete_forms'=>$deleteForms
        ));
    }

    /**
     * @param Devis $devis
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteFormProduit(Devis $devis)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('devis_delete', array('id' => $devis->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

    /**
     * @Route("/devis/{id}/delete", name="devis_delete")
     * @Method("DELETE")
     */
    public function deleteDevisAction(Request $request, Devis $devis)
    {
        $form = $this->createDeleteFormProduit($devis);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($devis);
            $em->flush($devis);
        }
        return $this->redirectToRoute('devis_index');
    }
    /**
     * @Route("devis/{id}/edit",name="devis_edit")
     * @Method("GET")
     */
    public function editDevisAction(Devis $devis)
    {
        // CREATION Formulaire DEVIS
        $form_devis = $this->createForm(DevisType::class,$devis);

        // CREATION Formulaire Ligne_Devis
        $form_ligne_devis = $this->createForm(LigneDevisType::class);

        return $this->render('BackOfficeBundle:Devis:newDevis.html.twig',array(
            'devis'=>$devis,
            'form_devis'=>$form_devis->createView(),
            'form_ligne_devis'=>$form_ligne_devis->createView()
        ));
    }
}

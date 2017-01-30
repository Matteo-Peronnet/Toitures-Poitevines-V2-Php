<?php

namespace BackOfficeBundle\Controller;

use BackOfficeBundle\Entity\Categorie;
use BackOfficeBundle\Entity\Produit;
use BackOfficeBundle\Form\CategorieType;
use BackOfficeBundle\Form\ProduitType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class DataController extends Controller
{
    /**
     * @Route("/categorie",name="categorie_index")
     */
    public function indexCategorieAction()
    {
        $repository_categorie = $this->getDoctrine()->getManager()->getRepository('BackOfficeBundle:Categorie');
        $categories = $repository_categorie->findBy([],['nom' => 'ASC']);

        $deleteForms = [];
        foreach($categories as $categorie){
            $deleteForms[$categorie->getId()] = $this->createDeleteFormCategorie($categorie)->createView();
        }

        return $this->render('BackOfficeBundle:Categorie:listeCategorie.html.twig',array(
            'categories'=>$categories,
            'delete_forms'=>$deleteForms
        ));
    }

    /**
     * @param Categorie $categorie
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteFormCategorie(Categorie $categorie)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('categorie_delete', array('id' => $categorie->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

    /**
     * @Route("/categorie/{id}/delete", name="categorie_delete")
     * @Method("DELETE")
     */
    public function deleteCategorieAction(Request $request, Categorie $categorie)
    {
        $form = $this->createDeleteFormCategorie($categorie);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($categorie);
            $em->flush($categorie);
        }
        return $this->redirectToRoute('categorie_index');
    }
    /**
     * @Route("/categorie/{id}/edit", name="categorie_edit")
     * @Method({"POST","GET"})
     */
    public function editCategorieAction(Request $request,Categorie $categorie){
        $form = $this->createForm(CategorieType::class,$categorie);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('categorie_index');
        }
        return $this->render('BackOfficeBundle:Categorie:editCategorie.html.twig',array(
            'categorie'=>$categorie,
            'form'=>$form->createView()
        ));
    }

    /**
     * @Route("/categorie/new", name="categorie_new")
     * @Method({"POST","GET"})
     */
    public function newCategorieAction(Request $request)
    {
        $categorie_max = $this->getDoctrine()->getRepository('BackOfficeBundle:Categorie')->getMaxPlacementCategorie();
        $categorie = new Categorie();
        $categorie->setPlacement(intval($categorie_max[1])+1);
        $form = $this->createForm(CategorieType::class,$categorie);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();
            return $this->redirectToRoute('categorie_index');
        }

        return $this->render('BackOfficeBundle:Categorie:addCategorie.html.twig',array(
            'categorie'=>$categorie,
            'form'=>$form->createView()
        ));
    }
    /**
     * @Route("produit/",name="produit_index")
     */
    public function indexProduitAction()
    {
        $repository_produit = $this->getDoctrine()->getManager()->getRepository('BackOfficeBundle:Produit');
        $produits = $repository_produit->findBy([],['categorie' => 'ASC']);

        $deleteForms = [];
        foreach($produits as $produit){
            $deleteForms[$produit->getId()] = $this->createDeleteFormProduit($produit)->createView();
        }

        return $this->render('BackOfficeBundle:Produit:listeProduit.html.twig',array(
            'produits'=>$produits,
            'delete_forms'=>$deleteForms
        ));
    }

    /**
     * @Route("/produit/{id}/delete", name="produit_delete")
     * @Method("DELETE")
     */
    public function deleteProduitAction(Request $request, Produit $produit)
    {
        $form = $this->createDeleteFormProduit($produit);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($produit);
            $em->flush($produit);
        }
        return $this->redirectToRoute('produit_index');
    }

    /**
     * @param Produit $produit
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteFormProduit(Produit $produit)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('produit_delete', array('id' => $produit->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

    /**
     * @Route("/produit/new", name="produit_new")
     * @Method({"POST","GET"})
     */
    public function newProduitAction(Request $request)
    {
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class,$produit);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($produit);
            $em->flush();
            return $this->redirectToRoute('produit_index');
        }

        return $this->render('BackOfficeBundle:Produit:addProduit.html.twig',array(
            'produit'=>$produit,
            'form'=>$form->createView()
        ));
    }

    /**
     * @Route("/produit/{id}/edit", name="produit_edit")
     * @Method({"POST","GET"})
     */
    public function editProduitAction(Request $request,Produit $produit){
        $form = $this->createForm(ProduitType::class,$produit);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('produit_index');
        }
        return $this->render('BackOfficeBundle:Produit:editProduit.html.twig',array(
            'produit'=>$produit,
            'form'=>$form->createView()
        ));
    }

}

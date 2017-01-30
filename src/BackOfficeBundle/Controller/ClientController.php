<?php

namespace BackOfficeBundle\Controller;

use BackOfficeBundle\Entity\Client;
use BackOfficeBundle\Form\ClientType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ClientController extends Controller
{
    /**
     * @Route("/client",name="client_index")
     */
    public function indexAction()
    {
        $repository_client = $this->getDoctrine()->getManager()->getRepository('BackOfficeBundle:Client');
        $clients = $repository_client->findAll();

        $deleteForms = [];
        foreach($clients as $client){
            $deleteForms[$client->getId()] = $this->createDeleteForm($client)->createView();
        }

        return $this->render('BackOfficeBundle:Client:listeClient.html.twig',array(
            'clients'=>$clients,
            'delete_forms'=>$deleteForms
        ));
    }

    /**
     * @Route("/client/new", name="client_new")
     * @Method({"POST","GET"})
     */
    public function newAction(Request $request)
    {
        $client = new Client();
        $form = $this->createForm(ClientType::class,$client);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($client);
            $em->flush();
            return $this->redirectToRoute('client_index');
        }

        return $this->render('BackOfficeBundle:Client:addClient.html.twig',array(
            'client'=>$client,
            'form'=>$form->createView()
        ));
    }


    /**
     * @Route("/client/{id}/edit", name="client_edit")
     * @Method({"POST","GET"})
     */
    public function editAction(Request $request,Client $client){
        $form = $this->createForm(ClientType::class,$client);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('client_index');
        }
        return $this->render('BackOfficeBundle:Client:editClient.html.twig',array(
            'client'=>$client,
            'form'=>$form->createView()
        ));
    }

    /**
     * @Route("/client/{id}/delete", name="client_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Client $client)
    {
        $form = $this->createDeleteForm($client);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($client);
            $em->flush($client);
        }

        return $this->redirectToRoute('client_index');
    }

    /**
     * @param Client $client
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Client $client)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('client_delete', array('id' => $client->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
    /**
     * @Route("/client/{id}/profile",name="client_profile")
     * @Method("GET")
     */
    public function profileAction(Request $request,Client $client)
    {
        return $this->render('BackOfficeBundle:Client:profileClient.html.twig',array(
            'client'=>$client,
        ));
    }


}

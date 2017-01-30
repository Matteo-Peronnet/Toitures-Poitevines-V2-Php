<?php

namespace BackOfficeBundle\Controller;

use BackOfficeBundle\Entity\Client;
use BackOfficeBundle\Form\ClientType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

class ClientController extends Controller
{
    /**
     * @Route("/client",name="client_index")
     */
    public function indexAction()
    {
        $repository_client = $this->getDoctrine()->getManager()->getRepository('BackOfficeBundle:Client');
        $clients = $repository_client->findAll();
        return $this->render('BackOfficeBundle:Client:listeClient.html.twig',array(
            'clients'=>$clients
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
        if($form->isSubmitted()) {
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
}

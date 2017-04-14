<?php

namespace BackOfficeBundle\Controller;

use BackOfficeBundle\Form\EntrepriseType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class SettingsController extends Controller
{
    /**
     * @Route("parametres")
     * @Method({"GET","POST"})
     */
    public function indexAction(Request $request)
    {
        $repository_settings = $this->getDoctrine()->getManager()->getRepository('BackOfficeBundle:Entreprise');
        $entreprise = $repository_settings->findAll();

        $form_settings = $this->createForm(EntrepriseType::class,$entreprise[0]);

        $form_settings->handleRequest($request);
        if($form_settings->isSubmitted() && $form_settings->isValid()){
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('index');
        }

        return $this->render('BackOfficeBundle:Settings:index.html.twig', array(
           'form_settings'=>$form_settings->createView()
        ));
    }

}

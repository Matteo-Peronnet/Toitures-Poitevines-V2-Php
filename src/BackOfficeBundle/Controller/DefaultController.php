<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function indexAction()
    {
        $repository_devis = $this->getDoctrine()->getManager()->getRepository('BackOfficeBundle:Devis');
        $liste_devis = $repository_devis->getLastsDevisNotBrouillon();

        return $this->render('BackOfficeBundle:Default:index.html.twig',array(
            'liste_devis'=>$liste_devis
        ));
    }
}

<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $repository_devis = $this->getDoctrine()->getManager()->getRepository('BackOfficeBundle:Devis');
        return $this->render('BackOfficeBundle:Default:index.html.twig');
    }
}

<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DevisController extends Controller
{
    /**
     * @Route("devis/new",name="devis_new")
     */
    public function newDevisAction()
    {

        return $this->render('BackOfficeBundle:Devis:newDevis.html.twig',array(

        ));
    }
}

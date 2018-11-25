<?php

namespace AppBundle\Controller\Frontend;

use AppBundle\Entity\ComGeneral;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ComGeneralController
 * @Route("commissariat-general")
 */
class ComGeneralController extends Controller
{
    /**
     * @Route("/", name="frontend_comgeneral_index")
     */
    public function indexAction()
    {
        $commissaires = $this->comgeneralRepository()->findAll();

        return $this->render('frontend/comgeneral_list.html.twig',[
            'commissaires' => $commissaires
        ]);
    }

    /**
     * @Route("/{slug}", name="frontend_comgeneral_show")
     * @Method("GET")
     */
    public function show(ComGeneral $comGeneral)
    {
        return $this->render('frontend/comgeneral_show.html.twig',[
            'commissaire' => $comGeneral
        ]);
    }

    /**
     * requete du commissariat general
     */
    public function comgeneralRepository()
    {
        return $this->getDoctrine()->getManager()->getRepository('AppBundle:ComGeneral');
    }
}
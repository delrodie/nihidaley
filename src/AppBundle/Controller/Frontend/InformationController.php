<?php

namespace AppBundle\Controller\Frontend;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class InformationController
 * @Route("information")
 */
class InformationController extends Controller
{
    /**
     * @Route("/", name="frontend_information_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        return $this->render('frontend/information_list.html.twig',[
            'informations' => $this->informationRepository()->findList(),
        ]);
    }

    /**
     * Requete Repository Information
     */
    public function informationRepository()
    {
        return $this->getDoctrine()->getManager()->getRepository('AppBundle:Information');
    }
}
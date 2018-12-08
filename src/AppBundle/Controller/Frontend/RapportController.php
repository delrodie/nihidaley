<?php

namespace AppBundle\Controller\Frontend;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class RapportController
 * @Route("rapport")
 */
class RapportController extends Controller
{
    /**
     * @Route("/", name="frontend_rapport_index")
     */
    public function indexAction()
    {
        $rapports = $this->rapportRepository()->findBy(array('statut'=>1), array('date'=>'DESC'));

        return $this->render('frontend/rapport_list.html.twig',[
            'rapports' => $rapports
        ]);
    }

    public function rapportRepository()
    {
        return $this->getDoctrine()->getManager()->getRepository('AppBundle:Rapport');
    }
}
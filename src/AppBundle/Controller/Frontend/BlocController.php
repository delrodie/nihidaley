<?php

namespace AppBundle\Controller\Frontend;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


/**
 * Class BlocController
 * @Route("bloc")
 */
class BlocController extends Controller
{
    /**
     * @Route("/", name="frontend_bloc")
     */
    public function menuAction()
    {
        $em = $this->getDoctrine()->getManager();

        $dat = date('Y-m-d', time()); //dump($dat);die();
        if ($dat < "2018-12-01") {
            $jour = "01 Dec 2018";
            $activites = $em->getRepository('AppBundle:Activite')->findByDay('01'); //die('nous sommes ici');
        }elseif ($dat > "2018-12-10"){
            $jour = null;
            $activites = $em->getRepository('AppBundle:Activite')->findByDay('11');
        }
        else{
            $jour = date('d M Y', time());
            $activites = $em->getRepository('AppBundle:Activite')->findByDay(date('d', time()));
        }



        return $this->render('frontend/bloc.html.twig',[
            'activites' => $activites,
            'jour' => $jour
        ]);
    }
}
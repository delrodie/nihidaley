<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $samedis01 = $em->getRepository('AppBundle:Activite')->findByDay('01'); //dump($samedis01);die();
        $dimanche02 = $em->getRepository('AppBundle:Activite')->findByDay('02'); //dump($samedis01);die();
        $lundi03 = $em->getRepository('AppBundle:Activite')->findByDay('03'); //dump($samedis01);die();
        $mardi04 = $em->getRepository('AppBundle:Activite')->findByDay('04'); //dump($samedis01);die();
        $mercredi05 = $em->getRepository('AppBundle:Activite')->findByDay('05'); //dump($samedis01);die();
        $jeudi06 = $em->getRepository('AppBundle:Activite')->findByDay('06'); //dump($samedis01);die();
        $vendredi07 = $em->getRepository('AppBundle:Activite')->findByDay('07'); //dump($samedis01);die();
        $samedi08 = $em->getRepository('AppBundle:Activite')->findByDay('08'); //dump($samedis01);die();
        $dimanche09 = $em->getRepository('AppBundle:Activite')->findByDay('09'); //dump($samedis01);die();
        $lundi10 = $em->getRepository('AppBundle:Activite')->findByDay('10'); //dump($samedis01);die();

        $actualites = $em->getRepository('AppBundle:Actualite')->findList(1);
        $galeries = $em->getRepository('AppBundle:Galerie')->findListDesc();
        return $this->render('default/index.html.twig', [
            'samedis01' => $samedis01,
            'dimanche02' => $dimanche02,
            'lundi03' => $lundi03,
            'mardi04' => $mardi04,
            'mercredi05' => $mercredi05,
            'jeudi06' => $jeudi06,
            'vendredi07' => $vendredi07,
            'samedi08' => $samedi08,
            'dimanche09' => $dimanche09,
            'lundi10' => $lundi10,
            'actualites' => $actualites,
            'galeries' => $galeries
        ]);
    }

    /**
     * @Route("/backend/", name="backend")
     */
    public function backendAction()
    {
        return $this->render('default/dashboard.html.twig');
    }
}

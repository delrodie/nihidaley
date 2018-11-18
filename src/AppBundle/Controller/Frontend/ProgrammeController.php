<?php

namespace AppBundle\Controller\Frontend;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("programme")
 */
class ProgrammeController extends Controller
{
    /**
     * @Route("/", name="frontend_programme_index")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $samedi01 = $em->getRepository('AppBundle:Activite')->findByDay('01'); //dump($samedis01);die();
        $dimanche02 = $em->getRepository('AppBundle:Activite')->findByDay('02'); //dump($samedis01);die();
        $lundi03 = $em->getRepository('AppBundle:Activite')->findByDay('03'); //dump($samedis01);die();
        $mardi04 = $em->getRepository('AppBundle:Activite')->findByDay('04'); //dump($samedis01);die();
        $mercredi05 = $em->getRepository('AppBundle:Activite')->findByDay('05'); //dump($samedis01);die();
        $jeudi06 = $em->getRepository('AppBundle:Activite')->findByDay('06'); //dump($samedis01);die();
        $vendredi07 = $em->getRepository('AppBundle:Activite')->findByDay('07'); //dump($samedis01);die();
        $samedi08 = $em->getRepository('AppBundle:Activite')->findByDay('08'); //dump($samedis01);die();
        $dimanche09 = $em->getRepository('AppBundle:Activite')->findByDay('09'); //dump($samedis01);die();
        $lundi10 = $em->getRepository('AppBundle:Activite')->findByDay('10'); //dump($samedis01);die();
        return $this->render('frontend/programme_list.html.twig', [
            'samedi01' => $samedi01,
            'dimanche02' => $dimanche02,
            'lundi03' => $lundi03,
            'mardi04' => $mardi04,
            'mercredi05' => $mercredi05,
            'jeudi06' => $jeudi06,
            'vendredi07' => $vendredi07,
            'samedi08' => $samedi08,
            'dimanche09' => $dimanche09,
            'lundi10' => $lundi10,
        ]);
    }
}
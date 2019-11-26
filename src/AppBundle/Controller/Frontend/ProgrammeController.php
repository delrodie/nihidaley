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
        $samedi01 = $em->getRepository('AppBundle:Activite')->findByDay('08'); //dump($samedis01);die();
        $dimanche02 = $em->getRepository('AppBundle:Activite')->findByDay('09'); //dump($samedis01);die();
        $lundi03 = $em->getRepository('AppBundle:Activite')->findByDay('10'); //dump($samedis01);die();
        $mardi04 = $em->getRepository('AppBundle:Activite')->findByDay('11'); //dump($samedis01);die();
        $mercredi05 = $em->getRepository('AppBundle:Activite')->findByDay('12'); //dump($samedis01);die();
        $jeudi06 = $em->getRepository('AppBundle:Activite')->findByDay('13'); //dump($samedis01);die();
        $vendredi07 = $em->getRepository('AppBundle:Activite')->findByDay('14'); //dump($samedis01);die();
        $samedi08 = $em->getRepository('AppBundle:Activite')->findByDay('15'); //dump($samedis01);die();
        $dimanche09 = $em->getRepository('AppBundle:Activite')->findByDay('16'); //dump($samedis01);die();
        $lundi10 = $em->getRepository('AppBundle:Activite')->findByDay('17'); //dump($samedis01);die();
        return $this->render('frontend/programme_list.html.twig', [
            'jour01' => $samedi01,
            'jour02' => $dimanche02,
            'jour03' => $lundi03,
            'jour04' => $mardi04,
            'jour05' => $mercredi05,
            'jour06' => $jeudi06,
            'jour07' => $vendredi07,
            'jour08' => $samedi08,
            'dimanche09' => $dimanche09,
            'lundi10' => $lundi10,
        ]);
    }
}

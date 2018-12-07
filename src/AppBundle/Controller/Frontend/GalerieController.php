<?php


namespace AppBundle\Controller\Frontend;

use AppBundle\Entity\Galerie;
use AppBundle\Entity\GaleriePhoto;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class GalerieController
 * @Route("galerie")
 */
class GalerieController extends Controller
{
    /**
     * @Route("/", name="frontend_galerie_index")
     */
    public function index()
    {
        $galeries = $this->getDoctrine()->getManager()->getRepository('AppBundle:Galerie')->findListDesc();

        return $this->render('frontend/galerie.html.twig',['galeries'=>$galeries]);
    }

    /**
     * @Route("/{slug}", name="frontend_galerie_show")
     * @Method({"GET","POST"})
     */
    public function showAction(Galerie $galerie)
    {
        $photos = $this->getDoctrine()->getManager()->getRepository('AppBundle:GaleriePhoto')->findBy(array('album'=>$galerie->getId()));
        return $this->render('frontend/galerie_show.html.twig',[
            'galerie' => $galerie,
            'photos' => $photos
        ]);
    }
}
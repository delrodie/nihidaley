<?php

namespace AppBundle\Controller\Frontend;

use AppBundle\Entity\Actualite;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ActualiteController
 * @Route("actualites")
 */
class ActualiteController extends Controller
{
    /**
     * @Route("/", name="frontend_actualites")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $actualites = $this->actualiteRepository()->findList(1);
        $presentation = $em->getRepository("AppBundle:Presentation")->findOneBy(['statut'=>true], ['id'=>'DESC']);
        return $this->render('frontend/actualite_list.html.twig',[
            'actualites' => $actualites,
            'presentation' => $presentation
        ]);
    }

    /**
     * @Route("/{slug}", name="frontend_actualite_show")
     */
    public function sowAction(Actualite $actualite)
    {
        return $this->render('frontend/actualite_show.html.twig',['actualite' => $actualite]);
    }

    public function actualiteRepository()
    {
        return $this->getDoctrine()->getManager()->getRepository('AppBundle:Actualite');
    }
}

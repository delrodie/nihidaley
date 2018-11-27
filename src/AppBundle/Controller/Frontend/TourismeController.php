<?php

namespace AppBundle\Controller\Frontend;


use AppBundle\Entity\Tourisme;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class TourismeController
 * @Route("tourisme")
 */
class TourismeController extends Controller
{
    /**
     * Menu
     * @Route("/", name="frontend_tourisme_menu")
     */
    public function menuAction()
    {
        $menus = $this->getDoctrine()->getManager()
                        ->getRepository('AppBundle:Tourisme')
                        ->findList()->getQuery()->getResult()
                    ;
        return $this->render('frontend/tourisme_menu.html.twig',[
            'menus' => $menus
        ]);
    }

    /**
     * Liste des photo
     * @Route("/{slug}", name="frontend_tourisme_show")
     * @Method({"GET", "POST"})
     */
    public function show(Tourisme $tourisme)
    {
        $em = $this->getDoctrine()->getManager();
        $photos = $em->getRepository('AppBundle:TourismePhoto')->findBySite($tourisme->getSlug());

        return $this->render('frontend/tourisme_list.html.twig',[
            'tourisme' => $tourisme,
            'photos' => $photos
        ]);
    }
}
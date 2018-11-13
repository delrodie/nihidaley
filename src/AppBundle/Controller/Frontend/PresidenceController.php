<?php

namespace AppBundle\Controller\Frontend;

use AppBundle\Entity\Presidence;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class PresidenceController
 * @Route("presidence")
 */
class PresidenceController extends Controller
{
    /**
     * @Route("/", name="frontend_presidence_index")
     */
    public function indexAction()
    {
        $presidents = $this->presidentRepository()->findAll();

        return $this->render('frontend/presidence_list.html.twig',[
            'presidents' => $presidents
        ]);
    }

    /**
     * @Route("/{slug}", name="frontend_presidence_show")
     * @Method("GET")
     */
    public function show(Presidence $presidence)
    {
        return $this->render('frontend/presidence_show.html.twig',[
            'president' => $presidence
        ]);
    }

    /**
     * liste des
     */
    public function presidentRepository()
    {
        return $this->getDoctrine()->getManager()->getRepository('AppBundle:Presidence');
    }
}
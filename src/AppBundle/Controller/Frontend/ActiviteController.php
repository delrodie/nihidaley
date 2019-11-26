<?php


namespace AppBundle\Controller\Frontend;


use AppBundle\Entity\Activite;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


/**
 * Class ActiviteController
 * @Route("/activites")
 */
class ActiviteController extends Controller
{
    /**
     * @Route("/", name="frontend_activite_index")
     * @Method("GET")
     */
    public function listAction()
    {
        $activites = $this->activiteRepository()->findActivite();

        return $this->render('frontend/activite_list.html.twig',[
            'activites' => $activites,
        ]);
    }

    /**
     * @Route("/{slug}", name="frontend_activite_show")
     * @Method("GET")
     */
    public function activteAction(Activite $activite)
    {
        return $this->render('frontend/activite_show.html.twig',[
            'activite' => $activite
        ]);
    }

    /**
     * Repository
     */
    public function activiteRepository()
    {
        return $activiteRepository = $this->getDoctrine()->getManager()->getRepository('AppBundle:Activite');
    }
}

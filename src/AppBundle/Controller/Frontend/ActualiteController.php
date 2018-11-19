<?php

namespace AppBundle\Controller\Frontend;

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
        return $this->render('frontend/actualite_show.html.twig');
    }
}
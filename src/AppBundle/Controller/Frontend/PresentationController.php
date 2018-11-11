<?php
namespace AppBundle\Controller\Frontend;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("presentation")
 */
class PresentationController extends Controller
{
    /**
     * @Route("/", name="frontend_presentation")
     */
    public function indexAction()
    {
        return $this->render('default/presentation.html.twig');
    }
}
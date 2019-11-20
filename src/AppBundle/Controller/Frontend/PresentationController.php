<?php
namespace AppBundle\Controller\Frontend;
use AppBundle\Entity\Presentation;
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
     * @Route("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $presentation = $em->getRepository("AppBundle:Presentation")->findOneBy(['statut'=>true], ['id'=>'DESC']);
        return $this->render('default/presentation.html.twig',[
            'presentation' => $presentation
        ]);
    }
}

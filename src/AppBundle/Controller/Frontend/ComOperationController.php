<?php

namespace AppBundle\Controller\Frontend;

use AppBundle\Entity\ComOperation;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ComOperationController
 * @Route("commission-operation")
 */
class ComOperationController extends Controller
{
    /**
     * @Route("/", name="frontend_comoperation_index")
     */
    public function indexAction()
    {
        return $this->render('frontend/comoperation_list.html.twig',[
            'operations' => $this->operationRepository()->findAll(),
        ]);
    }

    /**
     * @Route("/{slug}", name="frontend_comoperation_show")
     * @Method("GET")
     */
    public function show(ComOperation $operation)
    {
        return $this->render('frontend/comoperation_show.html.twig',[
            'operation' => $operation
        ]);
    }

    /**
     * Requete de la commission operationnelle
     */
    public function operationRepository()
    {
        return $this->getDoctrine()->getManager()->getRepository('AppBundle:ComOperation');
    }
}
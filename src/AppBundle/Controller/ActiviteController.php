<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Activite;
use AppBundle\Utils\Utilities;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Activite controller.
 *
 * @Route("backend/activite")
 */
class ActiviteController extends Controller
{
    /**
     * Lists all activite entities.
     *
     * @Route("/", name="backend_activite_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $activites = $em->getRepository('AppBundle:Activite')->findList();

        return $this->render('activite/index.html.twig', array(
            'activites' => $activites,
        ));
    }

    /**
     * Creates a new activite entity.
     *
     * @Route("/new", name="backend_activite_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, Utilities $utilities)
    {
        $activite = new Activite();
        $form = $this->createForm('AppBundle\Form\ActiviteType', $activite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $resume = $utilities->resume($activite->getContenu(), 100, '...', true);
            $activite->setResume($resume);
            $em->persist($activite);
            $em->flush();

            return $this->redirectToRoute('backend_activite_show', array('slug' => $activite->getSlug()));
        }

        return $this->render('activite/new.html.twig', array(
            'activite' => $activite,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a activite entity.
     *
     * @Route("/{slug}", name="backend_activite_show")
     * @Method("GET")
     */
    public function showAction(Activite $activite)
    {
        $deleteForm = $this->createDeleteForm($activite);

        return $this->render('activite/show.html.twig', array(
            'activite' => $activite,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing activite entity.
     *
     * @Route("/{slug}/edit", name="backend_activite_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Activite $activite, Utilities $utilities)
    {
        $deleteForm = $this->createDeleteForm($activite);
        $editForm = $this->createForm('AppBundle\Form\ActiviteType', $activite);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $resume = $utilities->resume($activite->getContenu(), 100, '...', true);
            $activite->setResume($resume);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('backend_activite_show', array('slug' => $activite->getSlug()));
        }

        return $this->render('activite/edit.html.twig', array(
            'activite' => $activite,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a activite entity.
     *
     * @Route("/{id}", name="backend_activite_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Activite $activite)
    {
        $form = $this->createDeleteForm($activite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($activite);
            $em->flush();
        }

        return $this->redirectToRoute('backend_activite_index');
    }

    /**
     * Creates a form to delete a activite entity.
     *
     * @param Activite $activite The activite entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Activite $activite)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('backend_activite_delete', array('id' => $activite->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

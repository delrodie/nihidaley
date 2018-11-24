<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ComGeneral;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Comgeneral controller.
 *
 * @Route("backend/comgeneral")
 */
class ComGeneralController extends Controller
{
    /**
     * Lists all comGeneral entities.
     *
     * @Route("/", name="backend_comgeneral_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $comGenerals = $em->getRepository('AppBundle:ComGeneral')->findAll();

        return $this->render('comgeneral/index.html.twig', array(
            'comGenerals' => $comGenerals,
        ));
    }

    /**
     * Creates a new comGeneral entity.
     *
     * @Route("/new", name="backend_comgeneral_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $comGeneral = new Comgeneral();
        $form = $this->createForm('AppBundle\Form\ComGeneralType', $comGeneral);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($comGeneral);
            $em->flush();

            return $this->redirectToRoute('backend_comgeneral_show', array('slug' => $comGeneral->getSlug()));
        }

        return $this->render('comgeneral/new.html.twig', array(
            'comGeneral' => $comGeneral,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a comGeneral entity.
     *
     * @Route("/{slug}", name="backend_comgeneral_show")
     * @Method("GET")
     */
    public function showAction(ComGeneral $comGeneral)
    {
        $deleteForm = $this->createDeleteForm($comGeneral);

        return $this->render('comgeneral/show.html.twig', array(
            'comGeneral' => $comGeneral,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing comGeneral entity.
     *
     * @Route("/{slug}/edit", name="backend_comgeneral_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ComGeneral $comGeneral)
    {
        $deleteForm = $this->createDeleteForm($comGeneral);
        $editForm = $this->createForm('AppBundle\Form\ComGeneralType', $comGeneral);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('backend_comgeneral_show', array('slug' => $comGeneral->getSlug()));
        }

        return $this->render('comgeneral/edit.html.twig', array(
            'comGeneral' => $comGeneral,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a comGeneral entity.
     *
     * @Route("/{id}", name="backend_comgeneral_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ComGeneral $comGeneral)
    {
        $form = $this->createDeleteForm($comGeneral);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($comGeneral);
            $em->flush();
        }

        return $this->redirectToRoute('backend_comgeneral_index');
    }

    /**
     * Creates a form to delete a comGeneral entity.
     *
     * @param ComGeneral $comGeneral The comGeneral entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ComGeneral $comGeneral)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('backend_comgeneral_delete', array('id' => $comGeneral->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

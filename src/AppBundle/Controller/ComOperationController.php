<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ComOperation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Comoperation controller.
 *
 * @Route("backend/comoperation")
 */
class ComOperationController extends Controller
{
    /**
     * Lists all comOperation entities.
     *
     * @Route("/", name="backend_comoperation_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $comOperations = $em->getRepository('AppBundle:ComOperation')->findAll();

        return $this->render('comoperation/index.html.twig', array(
            'comOperations' => $comOperations,
        ));
    }

    /**
     * Creates a new comOperation entity.
     *
     * @Route("/new", name="backend_comoperation_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $comOperation = new Comoperation();
        $form = $this->createForm('AppBundle\Form\ComOperationType', $comOperation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($comOperation);
            $em->flush();

            return $this->redirectToRoute('backend_comoperation_show', array('slug' => $comOperation->getSlug()));
        }

        return $this->render('comoperation/new.html.twig', array(
            'comOperation' => $comOperation,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a comOperation entity.
     *
     * @Route("/{slug}", name="backend_comoperation_show")
     * @Method("GET")
     */
    public function showAction(ComOperation $comOperation)
    {
        $deleteForm = $this->createDeleteForm($comOperation);

        return $this->render('comoperation/show.html.twig', array(
            'comOperation' => $comOperation,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing comOperation entity.
     *
     * @Route("/{slug}/edit", name="backend_comoperation_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ComOperation $comOperation)
    {
        $deleteForm = $this->createDeleteForm($comOperation);
        $editForm = $this->createForm('AppBundle\Form\ComOperationType', $comOperation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('backend_comoperation_show', array('slug' => $comOperation->getSlug()));
        }

        return $this->render('comoperation/edit.html.twig', array(
            'comOperation' => $comOperation,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a comOperation entity.
     *
     * @Route("/{id}", name="backend_comoperation_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ComOperation $comOperation)
    {
        $form = $this->createDeleteForm($comOperation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($comOperation);
            $em->flush();
        }

        return $this->redirectToRoute('backend_comoperation_index');
    }

    /**
     * Creates a form to delete a comOperation entity.
     *
     * @param ComOperation $comOperation The comOperation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ComOperation $comOperation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('backend_comoperation_delete', array('id' => $comOperation->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

<?php

namespace AppBundle\Controller;

use AppBundle\Entity\TypePresidence;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Typepresidence controller.
 *
 * @Route("backend/typepresidence")
 */
class TypePresidenceController extends Controller
{
    /**
     * Lists all typePresidence entities.
     *
     * @Route("/", name="backend_typepresidence_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $typePresidence = new Typepresidence();
        $form = $this->createForm('AppBundle\Form\TypePresidenceType', $typePresidence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($typePresidence);
            $em->flush();

            return $this->redirectToRoute('backend_typepresidence_index');
        }

        $typePresidences = $em->getRepository('AppBundle:TypePresidence')->findAll();

        return $this->render('typepresidence/index.html.twig', array(
            'typePresidences' => $typePresidences,
            'typePresidence' => $typePresidence,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new typePresidence entity.
     *
     * @Route("/new", name="backend_typepresidence_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $typePresidence = new Typepresidence();
        $form = $this->createForm('AppBundle\Form\TypePresidenceType', $typePresidence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($typePresidence);
            $em->flush();

            return $this->redirectToRoute('backend_typepresidence_show', array('id' => $typePresidence->getId()));
        }

        return $this->render('typepresidence/new.html.twig', array(
            'typePresidence' => $typePresidence,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a typePresidence entity.
     *
     * @Route("/{id}", name="backend_typepresidence_show")
     * @Method("GET")
     */
    public function showAction(TypePresidence $typePresidence)
    {
        $deleteForm = $this->createDeleteForm($typePresidence);

        return $this->render('typepresidence/show.html.twig', array(
            'typePresidence' => $typePresidence,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing typePresidence entity.
     *
     * @Route("/{slug}/edit", name="backend_typepresidence_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, TypePresidence $typePresidence)
    {
        $deleteForm = $this->createDeleteForm($typePresidence);
        $editForm = $this->createForm('AppBundle\Form\TypePresidenceType', $typePresidence);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('backend_typepresidence_index');
        }

        $em = $this->getDoctrine()->getManager();

        $typePresidences = $em->getRepository('AppBundle:TypePresidence')->findAll();

        return $this->render('typepresidence/edit.html.twig', array(
            'typePresidence' => $typePresidence,
            'typePresidences' => $typePresidences,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a typePresidence entity.
     *
     * @Route("/{id}", name="backend_typepresidence_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, TypePresidence $typePresidence)
    {
        $form = $this->createDeleteForm($typePresidence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($typePresidence);
            $em->flush();
        }

        return $this->redirectToRoute('backend_typepresidence_index');
    }

    /**
     * Creates a form to delete a typePresidence entity.
     *
     * @param TypePresidence $typePresidence The typePresidence entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TypePresidence $typePresidence)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('backend_typepresidence_delete', array('id' => $typePresidence->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

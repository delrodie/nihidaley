<?php

namespace AppBundle\Controller;

use AppBundle\Entity\TourismePhoto;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Tourismephoto controller.
 *
 * @Route("backend/tourismephoto")
 */
class TourismePhotoController extends Controller
{
    /**
     * Lists all tourismePhoto entities.
     *
     * @Route("/", name="backend_tourismephoto_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tourismePhotos = $em->getRepository('AppBundle:TourismePhoto')->findListDesc();

        return $this->render('tourismephoto/index.html.twig', array(
            'tourismePhotos' => $tourismePhotos,
        ));
    }

    /**
     * Creates a new tourismePhoto entity.
     *
     * @Route("/new", name="backend_tourismephoto_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $tourismePhoto = new Tourismephoto();
        $form = $this->createForm('AppBundle\Form\TourismePhotoType', $tourismePhoto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tourismePhoto);
            $em->flush();

            return $this->redirectToRoute('backend_tourismephoto_new');
        }

        return $this->render('tourismephoto/new.html.twig', array(
            'tourismePhoto' => $tourismePhoto,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tourismePhoto entity.
     *
     * @Route("/{id}", name="backend_tourismephoto_show")
     * @Method("GET")
     */
    public function showAction(TourismePhoto $tourismePhoto)
    {
        $deleteForm = $this->createDeleteForm($tourismePhoto);

        return $this->render('tourismephoto/show.html.twig', array(
            'tourismePhoto' => $tourismePhoto,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tourismePhoto entity.
     *
     * @Route("/{id}/edit", name="backend_tourismephoto_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, TourismePhoto $tourismePhoto)
    {
        $deleteForm = $this->createDeleteForm($tourismePhoto);
        $editForm = $this->createForm('AppBundle\Form\TourismePhotoType', $tourismePhoto);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('backend_tourismephoto_index');
        }

        return $this->render('tourismephoto/edit.html.twig', array(
            'tourismePhoto' => $tourismePhoto,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tourismePhoto entity.
     *
     * @Route("/{id}", name="backend_tourismephoto_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, TourismePhoto $tourismePhoto)
    {
        $form = $this->createDeleteForm($tourismePhoto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tourismePhoto);
            $em->flush();
        }

        return $this->redirectToRoute('backend_tourismephoto_index');
    }

    /**
     * Creates a form to delete a tourismePhoto entity.
     *
     * @param TourismePhoto $tourismePhoto The tourismePhoto entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TourismePhoto $tourismePhoto)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('backend_tourismephoto_delete', array('id' => $tourismePhoto->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

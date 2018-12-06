<?php

namespace AppBundle\Controller;

use AppBundle\Entity\GaleriePhoto;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Galeriephoto controller.
 *
 * @Route("backend/galeriephoto")
 */
class GaleriePhotoController extends Controller
{
    /**
     * Lists all galeriePhoto entities.
     *
     * @Route("/", name="backend_galeriephoto_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $galeriePhotos = $em->getRepository('AppBundle:GaleriePhoto')->findListDesc();

        return $this->render('galeriephoto/index.html.twig', array(
            'galeriePhotos' => $galeriePhotos,
        ));
    }

    /**
     * Creates a new galeriePhoto entity.
     *
     * @Route("/new", name="backend_galeriephoto_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $galeriePhoto = new Galeriephoto();
        $form = $this->createForm('AppBundle\Form\GaleriePhotoType', $galeriePhoto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($galeriePhoto);
            $em->flush();

            return $this->redirectToRoute('backend_galeriephoto_new');
        }

        return $this->render('galeriephoto/new.html.twig', array(
            'galeriePhoto' => $galeriePhoto,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a galeriePhoto entity.
     *
     * @Route("/{id}", name="backend_galeriephoto_show")
     * @Method("GET")
     */
    public function showAction(GaleriePhoto $galeriePhoto)
    {
        $deleteForm = $this->createDeleteForm($galeriePhoto);

        return $this->render('galeriephoto/show.html.twig', array(
            'galeriePhoto' => $galeriePhoto,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing galeriePhoto entity.
     *
     * @Route("/{id}/edit", name="backend_galeriephoto_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, GaleriePhoto $galeriePhoto)
    {
        $deleteForm = $this->createDeleteForm($galeriePhoto);
        $editForm = $this->createForm('AppBundle\Form\GaleriePhotoType', $galeriePhoto);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('backend_galeriephoto_index');
        }

        return $this->render('galeriephoto/edit.html.twig', array(
            'galeriePhoto' => $galeriePhoto,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a galeriePhoto entity.
     *
     * @Route("/{id}", name="backend_galeriephoto_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, GaleriePhoto $galeriePhoto)
    {
        $form = $this->createDeleteForm($galeriePhoto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($galeriePhoto);
            $em->flush();
        }

        return $this->redirectToRoute('backend_galeriephoto_index');
    }

    /**
     * Creates a form to delete a galeriePhoto entity.
     *
     * @param GaleriePhoto $galeriePhoto The galeriePhoto entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(GaleriePhoto $galeriePhoto)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('backend_galeriephoto_delete', array('id' => $galeriePhoto->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

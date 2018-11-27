<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Tourisme;
use AppBundle\Utils\Utilities;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Tourisme controller.
 *
 * @Route("backend/tourisme")
 */
class TourismeController extends Controller
{
    /**
     * Lists all tourisme entities.
     *
     * @Route("/", name="backend_tourisme_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tourismes = $em->getRepository('AppBundle:Tourisme')->findAll();

        return $this->render('tourisme/index.html.twig', array(
            'tourismes' => $tourismes,
        ));
    }

    /**
     * Creates a new tourisme entity.
     *
     * @Route("/new", name="backend_tourisme_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, Utilities $utilities)
    {
        $tourisme = new Tourisme();
        $form = $this->createForm('AppBundle\Form\TourismeType', $tourisme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $resume = $utilities->resume($tourisme->getDescription(), 100, '...', true);
            $tourisme->setResume($resume);
            $em->persist($tourisme);
            $em->flush();

            return $this->redirectToRoute('backend_tourisme_show', array('slug' => $tourisme->getSlug()));
        }

        return $this->render('tourisme/new.html.twig', array(
            'tourisme' => $tourisme,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tourisme entity.
     *
     * @Route("/{slug}", name="backend_tourisme_show")
     * @Method("GET")
     */
    public function showAction(Tourisme $tourisme)
    {
        $deleteForm = $this->createDeleteForm($tourisme);

        return $this->render('tourisme/show.html.twig', array(
            'tourisme' => $tourisme,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tourisme entity.
     *
     * @Route("/{slug}/edit", name="backend_tourisme_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Tourisme $tourisme, Utilities $utilities)
    {
        $deleteForm = $this->createDeleteForm($tourisme);
        $editForm = $this->createForm('AppBundle\Form\TourismeType', $tourisme);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $resume = $utilities->resume($tourisme->getDescription(), 100, '...', true);
            $tourisme->setResume($resume);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('backend_tourisme_show', array('slug' => $tourisme->getSlug()));
        }

        return $this->render('tourisme/edit.html.twig', array(
            'tourisme' => $tourisme,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tourisme entity.
     *
     * @Route("/{id}", name="backend_tourisme_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Tourisme $tourisme)
    {
        $form = $this->createDeleteForm($tourisme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tourisme);
            $em->flush();
        }

        return $this->redirectToRoute('backend_tourisme_index');
    }

    /**
     * Creates a form to delete a tourisme entity.
     *
     * @param Tourisme $tourisme The tourisme entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tourisme $tourisme)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('backend_tourisme_delete', array('id' => $tourisme->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

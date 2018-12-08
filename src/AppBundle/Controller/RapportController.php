<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Rapport;
use AppBundle\Utils\Utilities;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Rapport controller.
 *
 * @Route("backend/rapport")
 */
class RapportController extends Controller
{
    /**
     * Lists all rapport entities.
     *
     * @Route("/", name="backend_rapport_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $rapports = $em->getRepository('AppBundle:Rapport')->findAll();

        return $this->render('rapport/index.html.twig', array(
            'rapports' => $rapports,
        ));
    }

    /**
     * Creates a new rapport entity.
     *
     * @Route("/new", name="backend_rapport_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, Utilities $utilities)
    {
        $rapport = new Rapport();
        $form = $this->createForm('AppBundle\Form\RapportType', $rapport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $resume = $utilities->resume($rapport->getDescription(), 100, '...', true);
            $rapport->setResume($resume);
            $em->persist($rapport);
            $em->flush();

            return $this->redirectToRoute('backend_rapport_show', array('slug' => $rapport->getSlug()));
        }

        return $this->render('rapport/new.html.twig', array(
            'rapport' => $rapport,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a rapport entity.
     *
     * @Route("/{slug}", name="backend_rapport_show")
     * @Method("GET")
     */
    public function showAction(Rapport $rapport)
    {
        $deleteForm = $this->createDeleteForm($rapport);

        return $this->render('rapport/show.html.twig', array(
            'rapport' => $rapport,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing rapport entity.
     *
     * @Route("/{slug}/edit", name="backend_rapport_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Rapport $rapport, Utilities $utilities)
    {
        $deleteForm = $this->createDeleteForm($rapport);
        $editForm = $this->createForm('AppBundle\Form\RapportType', $rapport);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $resume = $utilities->resume($rapport->getDescription(), 100, '...', true);
            $rapport->setResume($resume);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('backend_rapport_show', array('slug' => $rapport->getSlug()));
        }

        return $this->render('rapport/edit.html.twig', array(
            'rapport' => $rapport,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a rapport entity.
     *
     * @Route("/{id}", name="backend_rapport_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Rapport $rapport)
    {
        $form = $this->createDeleteForm($rapport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($rapport);
            $em->flush();
        }

        return $this->redirectToRoute('backend_rapport_index');
    }

    /**
     * Creates a form to delete a rapport entity.
     *
     * @param Rapport $rapport The rapport entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Rapport $rapport)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('backend_rapport_delete', array('id' => $rapport->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

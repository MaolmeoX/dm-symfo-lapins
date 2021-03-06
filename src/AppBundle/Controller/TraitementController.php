<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Traitement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Traitement controller.
 *
 * @Route("traitement")
 */
class TraitementController extends Controller
{
    /**
     * Lists all traitement entities.
     *
     * @Route("/", name="traitement_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $traitements = $em->getRepository('AppBundle:Traitement')->findAll();

        return $this->render('AppBundle:traitement:index.html.twig', array(
            'traitements' => $traitements,
        ));
    }

    /**
     * Creates a new traitement entity.
     *
     * @Route("/new", name="traitement_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $traitement = new Traitement();
        $form = $this->createForm('AppBundle\Form\TraitementType', $traitement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($traitement);
            $em->flush();

            return $this->redirectToRoute('traitement_show', array('id' => $traitement->getId()));
        }

        return $this->render('AppBundle:traitement:new.html.twig', array(
            'traitement' => $traitement,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a traitement entity.
     *
     * @Route("/{id}", name="traitement_show")
     * @Method("GET")
     */
    public function showAction(Traitement $traitement)
    {
        $deleteForm = $this->createDeleteForm($traitement);

        return $this->render('AppBundle:traitement:show.html.twig', array(
            'traitement' => $traitement,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing traitement entity.
     *
     * @Route("/{id}/edit", name="traitement_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Traitement $traitement)
    {
        $deleteForm = $this->createDeleteForm($traitement);
        $editForm = $this->createForm('AppBundle\Form\TraitementType', $traitement);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('traitement_edit', array('id' => $traitement->getId()));
        }

        return $this->render('AppBundle:traitement:edit.html.twig', array(
            'traitement' => $traitement,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a traitement entity.
     *
     * @Route("/{id}", name="traitement_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Traitement $traitement)
    {
        $form = $this->createDeleteForm($traitement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($traitement);
            $em->flush();
        }

        return $this->redirectToRoute('traitement_index');
    }

    /**
     * Creates a form to delete a traitement entity.
     *
     * @param Traitement $traitement The traitement entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Traitement $traitement)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('traitement_delete', array('id' => $traitement->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

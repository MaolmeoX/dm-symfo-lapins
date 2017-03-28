<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Docteur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Docteur controller.
 *
 * @Route("docteur")
 */
class DocteurController extends Controller
{
    /**
     * Lists all docteur entities.
     *
     * @Route("/", name="docteur_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $docteurs = $em->getRepository('AppBundle:Docteur')->findAll();

        return $this->render('AppBundle:docteur:index.html.twig', array(
            'docteurs' => $docteurs,
        ));
    }

    /**
     * Creates a new docteur entity.
     *
     * @Route("/new", name="docteur_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $docteur = new Docteur();
        $form = $this->createForm('AppBundle\Form\DocteurType', $docteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($docteur);
            $em->flush();

            return $this->redirectToRoute('docteur_show', array('id' => $docteur->getId()));
        }

        return $this->render('AppBundle:docteur:new.html.twig', array(
            'docteur' => $docteur,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a docteur entity.
     *
     * @Route("/{id}", name="docteur_show")
     * @Method("GET")
     */
    public function showAction(Docteur $docteur)
    {
        $deleteForm = $this->createDeleteForm($docteur);

        return $this->render('AppBundle:docteur:show.html.twig', array(
            'docteur' => $docteur,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing docteur entity.
     *
     * @Route("/{id}/edit", name="docteur_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Docteur $docteur)
    {
        $deleteForm = $this->createDeleteForm($docteur);
        $editForm = $this->createForm('AppBundle\Form\DocteurType', $docteur);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('docteur_edit', array('id' => $docteur->getId()));
        }

        return $this->render('AppBundle:docteur:edit.html.twig', array(
            'docteur' => $docteur,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a docteur entity.
     *
     * @Route("/{id}", name="docteur_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Docteur $docteur)
    {
        $form = $this->createDeleteForm($docteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($docteur);
            $em->flush();
        }

        return $this->redirectToRoute('docteur_index');
    }

    /**
     * Creates a form to delete a docteur entity.
     *
     * @param Docteur $docteur The docteur entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Docteur $docteur)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('docteur_delete', array('id' => $docteur->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

<?php

namespace Galileo\SimpleBet\ModelBundle\Controller;

use Galileo\SimpleBet\MainBundle\Service\Comparer\ScoreCompareInterface;
use Galileo\SimpleBet\MainBundle\Service\Comparer\SimpleScoreCompare;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Galileo\SimpleBet\ModelBundle\Entity\Game;
use Galileo\SimpleBet\ModelBundle\Entity\Bet;
use Galileo\SimpleBet\ModelBundle\Form\GameType;

/**
 * Game controller.
 *
 */
class GameController extends Controller
{

    /**
     * Lists all Game entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('GalileoSimpleBetModelBundle:Game')->findBy(array(), array('id' => 'DESC'));

        return $this->render('GalileoSimpleBetModelBundle:Game:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new Game entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Game();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_game_show', array('id' => $entity->getId())));
        }

        return $this->render('GalileoSimpleBetModelBundle:Game:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Game entity.
     *
     * @param Game $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Game $entity)
    {
        $form = $this->createForm(new GameType(), $entity, array(
            'action' => $this->generateUrl('admin_game_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Game entity.
     *
     */
    public function newAction()
    {
        $entity = new Game();
        $form = $this->createCreateForm($entity);

        return $this->render('GalileoSimpleBetModelBundle:Game:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Game entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GalileoSimpleBetModelBundle:Game')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Game entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('GalileoSimpleBetModelBundle:Game:show.html.twig', array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),));
    }

    /**
     * Displays a form to edit an existing Game entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GalileoSimpleBetModelBundle:Game')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Game entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('GalileoSimpleBetModelBundle:Game:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Game entity.
     *
     * @param Game $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Game $entity)
    {
        $form = $this->createForm(new GameType(), $entity, array(
            'action' => $this->generateUrl('admin_game_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Game entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GalileoSimpleBetModelBundle:Game')->find($id);

        $beforeEntity = clone $entity;

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Game entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $this->updateBets($beforeEntity, $entity);

            return $this->redirect($this->generateUrl('admin_game_edit', array('id' => $id)));
        }

        return $this->render('GalileoSimpleBetModelBundle:Game:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Game entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GalileoSimpleBetModelBundle:Game')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Game entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_game'));
    }

    /**
     * Creates a form to delete a Game entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_game_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm();
    }

    protected function updateBets(Game $beforeEntity, Game $game)
    {
        $shouldCalculateBets = $beforeEntity->getIsPlayed() <> $game->getIsPlayed();

        if ($shouldCalculateBets) {
            if ($game->getIsPlayed()) {
                $this->addPoints($game);
            } else {
                $this->removePoints($game);
            }
        }
    }

    private function removePoints(Game $game)
    {
        $em = $this->getDoctrine()->getManager();

        /** @var Bet $bet */
        foreach ($game->getBets() as $bet) {

            $bet->setPointsEarned(0);
            $em->persist($bet);
        }
        $em->flush();
    }

    private function addPoints(Game $game)
    {
        $em = $this->getDoctrine()->getManager();

        /** @var Bet $bet */
        foreach ($game->getBets() as $bet) {
            $bet->calculateScore($game);
            $em->persist($bet);
        }
        $em->flush();

    }
}

<?php


namespace Galileo\SimpleBet\MainBundle\Controller;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Galileo\SimpleBet\MainBundle\Service\Manager\CurrentPlayerManager;
use Galileo\SimpleBet\ModelBundle\Entity\ChatMessage;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Router;

class ChatMessageController
{
    /**
     * @var EntityRepository
     */
    protected $tournamentRepository;

    /**
     * @var EngineInterface
     */
    protected $templating;
    /**
     * @var \Doctrine\ORM\EntityRepository
     */
    protected $chatMessageRepository;

    /**
     * @var \Galileo\SimpleBet\MainBundle\Service\Manager\CurrentPlayerManager
     */
    protected $playerManager;

    /**
     * @var FormFactory
     */
    protected $formFactory;

    /**
     * @var Router
     */
    protected $router;

    /**
     * @var EntityManager
     */
    protected $entityManager;

    function __construct(EngineInterface $templating,
                         EntityRepository $tournamentRepository,
                         EntityRepository $chatMessageRepository,
                         CurrentPlayerManager $playerManager,
                         FormFactory $formFactory,
                         Router $router,
                         EntityManager $entityManager
    )
    {
        $this->tournamentRepository = $tournamentRepository;
        $this->templating = $templating;
        $this->chatMessageRepository = $chatMessageRepository;
        $this->playerManager = $playerManager;
        $this->formFactory = $formFactory;

        $this->player = $this->playerManager->getCurrentPlayer();
        $this->router = $router;
        $this->entityManager = $entityManager;
    }

    public function viewChatMessagesAction($tournamentId)
    {
        $tournament = $this->tournamentRepository->find($tournamentId);

        if (null === $tournament) {
            throw new NotFoundHttpException(sprintf('Tournament %d not found.', $tournamentId));
        }

        $messages = $this->chatMessageRepository->findBy(array('tournament' => $tournament), array('id' => 'DESC'));


        $message = new ChatMessage();
        $form = $this->formFactory
            ->createBuilder('form', $message)
            ->setAction($this->messageUrl($tournamentId))
            ->add('message', 'text', array('label' => 'Wiadomość'))
            ->add('Dodaj', 'submit')
            ->getForm();


        return $this->templating->renderResponse('GalileoSimpleBetMainBundle:ChatMessage:viewTournamentChat.html.twig',
            array('messages' => $messages, 'form' => $form->createView())
        );
    }

    public function addChatMessageAction()
    {

        $message = new ChatMessage();
        $form = $this->formFactory
            ->createBuilder('form', $message)
            ->add('message', 'text')
            ->add('dodaj', 'submit')
            ->getForm();


    }

    public function createChatMessageAction(Request $request, $tournamentId)
    {
        $tournament = $this->tournamentRepository->find($tournamentId);
        if (null === $tournament) {
            throw new NotFoundHttpException(sprintf('Tournament %d not found.', $tournamentId));
        }


        $message = new ChatMessage();
        $message->setDate(new \DateTime());
        $message->setTournament($tournament);
        $message->setPlayer($this->player);

        $form = $this->formFactory
            ->createBuilder('form', $message)
            ->setAction($this->messageUrl($tournamentId))
            ->add('message', 'text')
            ->add('dodaj', 'submit')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->entityManager->persist($message);
            $this->entityManager->flush();

            $referer = $request->headers->get('referer');

            return new RedirectResponse($referer);
        }

    }

    protected function messageUrl($tournamentId)
    {
        return $this->router->generate(
            'gsbm_player_add_message', array(
                'tournamentId' => $tournamentId,
            )
        );
    }


}
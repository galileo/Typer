<?php


namespace Galileo\SimpleBet\MainBundle\Service\Manager;


use Galileo\SimpleBet\ModelBundle\Entity\Player;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\SecurityContextInterface;

class CurrentPlayerManager
{

    /**
     * @var
     */
    private $context;

    function __construct(SecurityContextInterface $context)
    {
        $this->context = $context;
    }


    /**
     * @throws \Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException
     *
     * @return Player
     */
    public function getCurrentPlayer()
    {
        $user = $this->context->getToken()->getUser();

        if ('anon.' === $user) {
            throw new UnauthorizedHttpException('Please log in');
        }

        return $user;
    }

    /**
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     *
     * @return Player
     */
    public function getLoggedOrFail()
    {
        if (!$this->context->getToken()->isAuthenticated())
        {
            throw new AccessDeniedException('User not logged in.');
        }

        return $this->context->getToken()->getUser();
    }


}
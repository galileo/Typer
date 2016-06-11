<?php

namespace Galileo\SimpleBet\MainBundle\Transformer;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

use Galileo\SimpleBet\ModelBundle\Entity\Score;

class ScoreTransformer implements DataTransformerInterface
{
    /**
     * @var ObjectManager
     */
    protected $objectManager;

    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * {@inheritdoc}
     * @param Score|null $score
     */
    public function transform($score)
    {
        if (null === $score) {
            return "";
        }

        return sprintf('%d:%d', $score->getHome(), $score->getAway());
    }

    /**
     * {@inheritdoc}
     */
    public function reverseTransform($scoreString)
    {
        if (null === $scoreString) {
            return null;
        }

        if (!preg_match('@^\d+:\d+$@', $scoreString)) {
            throw new TransformationFailedException(sprintf(
                'String is not valid score string format for example: 1:2'
            ));
        }

        list($home, $away) = explode(':', $scoreString, 2);

        $score = $this->objectManager
            ->getRepository('GalileoSimpleBetModelBundle:Score')
            ->findOneBy(array(
                'home' => $home,
                'away' => $away,
            ));

        if (null === $score) {
            $score = new Score();
            $score
                ->setHome($home)
                ->setAway($away)
                ->setScoreType('simple');
        }

        return $score;
    }
}

<?php

namespace Galileo\SimpleBet\ModelBundle\Form\Type;

use Doctrine\ORM\EntityManager;
use Galileo\SimpleBet\MainBundle\Transformer\BetTransformer;
use Galileo\SimpleBet\MainBundle\Transformer\ScoreTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BetScoreType extends AbstractType
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {

        $this->entityManager = $entityManager;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $em = $this->entityManager;

        $builder
            ->add(
                $builder->create('score', 'text', array('label' => 'Wpisz wynik np. 1:2 ',
                    'invalid_message' => 'Wynik wpisany w złym formacie poprawny to goleDomowe:goleWyjazdowe przykładowo: 2:1'))
                    ->addModelTransformer(
                        new ScoreTransformer($em)
                    )
            )
            ->add('save', 'submit', array('label' => 'Zapisz'));
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults(array(
                'data_class' => 'Galileo\SimpleBet\ModelBundle\Entity\Bet',
                'cascade_validation' => true,
            ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'bet_score';
    }
}

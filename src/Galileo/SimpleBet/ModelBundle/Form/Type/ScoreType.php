<?php

namespace Galileo\SimpleBet\ModelBundle\Form\Type;

use Doctrine\ORM\EntityManager;
use Galileo\SimpleBet\MainBundle\Transformer\ScoreTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ScoreType extends AbstractType
{

    /**
     * @var EntityManager
     */
    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {

        $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('home', 'text', array('label' => 'Gole gosporarzy'))
            ->add('away', 'text', array('label' => 'Gole gości'))
            ->add('score', 'text', array('label' => 'Wynik'))

            ->add('save', 'submit')->addModelTransformer(new ScoreTransformer($this->entityManager));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
                'data_class' => 'Galileo\SimpleBet\ModelBundle\Entity\Score',
            )
        );
    }


    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'score_string';
    }
}
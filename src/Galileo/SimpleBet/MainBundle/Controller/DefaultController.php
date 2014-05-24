<?php

namespace Galileo\SimpleBet\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('GalileoSimpleBetMainBundle:Default:index.html.twig');
    }

    public function defaultAction()
    {
        return $this->render('GalileoSimpleBetMainBundle:Default:default.html.twig');
    }

}

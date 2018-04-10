<?php

namespace bpBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('bpBundle:Default:index.html.twig');
    }
}

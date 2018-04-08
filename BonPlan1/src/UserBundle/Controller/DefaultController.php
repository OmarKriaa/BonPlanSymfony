<?php

namespace UserBundle\Controller;
use UserBundle\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('UserBundle:Default:index.html.twig');
    }
    public function registerAction()
    {
        return $this->render('UserBundle:Registration:register_content.html.twig');
    }
    public function loginAction()
    {
        return $this->render('UserBundle:Security:login_content.html.twig');
    }
    public function showAction()
    {
        return $this->render('UserBundle:Profile:show_content.html.twig');
    }
    public function editAction()
    {
        return $this->render('UserBundle:Profile:show_content.html.twig');
    }

    public function logoutAction()
    {
        return $this->render('UserBundle:Default:index.html.twig');
    }


}

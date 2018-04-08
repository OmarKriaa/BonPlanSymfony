<?php

namespace PartageExperienceBundle\Controller;

use PartageExperienceBundle\Form\PartageHType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use PartageExperienceBundle\Entity\PartageH;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PartageExperienceBundle::Default:PartageAvis.html.twig');
    }


    public function AvisAction()
    {
        return $this->render('PartageExperienceBundle::Default:PartageAvis.html.twig');
    }


}
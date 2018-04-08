<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 22/03/2018
 * Time: 15:06
 */

namespace PartageExperienceBundle\Controller;

use PartageExperienceBundle\Entity\Contact;
use PartageExperienceBundle\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class ContactController extends Controller
{

    public function ContactAction(Request $request)
    {
        $Contact = new Contact();
        $form = $this->createForm(ContactType::class,$Contact);

        $form->handleRequest($request);

        if ($form->isValid()) { // suite au clic sur le bouton

            $em = $this->getDoctrine()->getManager();
            $Contact->setDateCommentaire(new \Datetime('now'));


            $em->persist($Contact);
            $em->flush();
            return $this->redirectToRoute("Contact");

        }
        return $this->render('PartageExperienceBundle:Contact:contact.html.twig', array(

            "form" => $form->createView()

        ));
    }
}
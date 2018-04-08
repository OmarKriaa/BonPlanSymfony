<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 06/04/2018
 * Time: 20:36
 */

namespace PartageExperienceBundle\Controller;



use PartageExperienceBundle\Entity\Mail;
use PartageExperienceBundle\Form\MailType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Swift_Message;
use Symfony\Component\HttpFoundation\Request;

class MailController extends Controller
{
    public function indexAction(Request $request)
    {
        $mail = new Mail();
    $form=  $this->createForm(MailType::class,  $mail);
    $form->handleRequest($request) ;
    if ($form->isSubmitted())
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('Accusé de réception')
            ->setFrom('omarkriaa2018@gmail.com')
            ->setTo($mail->getEmail())
            ->setBody(
                $this->renderView('PartageExperienceBundle:Default:email.html.twig',
                    array(
                        'nom' => $mail->getNom(), 'prenom'=>$mail->getPrenom())
                ),
                'text/html');
        $this->get('mailer')->send($message);
        echo "<div class='alert alert-block alert-success'>
                    <button type='button' class='close' data-dismiss='alert'>
                        <i class='ace-icon fa fa-times'></i>
                         </button>
                        <i class='ace-icon fa fa-check green'></i>
               E-mail envoyé avec 
                <strong class='green'>succès</strong>
                </div>";
        return $this->redirect($this->generateUrl('my_app_mail_accuse'));
    }

        return $this->render('PartageExperienceBundle:Default:indexMail.html.twig',
            array('form'=>$form->createView()));
    }

    public function successAction(){
        return new Response("email envoyé avec succès, Merci de vérifier votre adresse mail.");
    }
}
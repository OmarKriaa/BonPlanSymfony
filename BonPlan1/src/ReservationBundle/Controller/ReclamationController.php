<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 05/04/2018
 * Time: 16:53
 */

namespace ReservationBundle\Controller;


use ReservationBundle\Entity\Reclamation;
use ReservationBundle\Form\ReclamationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ReclamationController extends Controller
{
    public function ajoutAction(Request $request)
    {



        $reclamation = new Reclamation();
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);
        if ($form->isValid()) {
            //suite au click sur le bouton submit


            $re = $this->getDoctrine()->getManager();
            $re->persist($reclamation);
            $re->flush();
            return $this->redirectToRoute("ajoutReclamation");
        }
        return $this->render("ReservationBundle:Reclamation:ajoutReclamation.html.twig",
            array("Form" => $form->createView()
            )
        );
    }




}
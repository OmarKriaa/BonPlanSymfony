<?php

namespace ReservationBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ReservationBundle\Form\ReservationType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use ReservationBundle\Entity\Reservation;
use ReservationBundle\Entity\ReservationRepository;

use Braintree_Transaction;
use Braintree_Gateway;


class DefaultController extends Controller
{
    public function indexAction()
    {

        return $this->render('ReservationBundle:Default:index.html.twig');
    }


    public function ajoutAction(Request $request)
    {
        $now = new \DateTime('now');


        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);
        if ($form->isValid()) {
            //suite au click sur le bouton submit
            if ($reservation->getDateentree() > $reservation->getDatesortie() || $reservation->getDateentree() < $now) {
                echo 'ggg';
            } else {

                $nbJours= $reservation->getDatesortie()->format(('d/m/Y')) - $reservation->getDateentree()->format(('d/m/Y'));
                $reservation->setNbrnuit($nbJours);
                $reservation->setIdpersonne($this->getUser());


                $re = $this->getDoctrine()->getManager();
                $re->persist($reservation);
                $re->flush();
                return $this->redirectToRoute("aff");
            }
        }
        return $this->render("ReservationBundle:Reservation:ajout.html.twig",
            array("Form" => $form->createView()
            )
        );
    }

    public function afficherReservationAction()
    {
        $re = $this->getDoctrine()->getManager();
        $reservation = $re->getRepository("ReservationBundle:Reservation")
            ->maj($this->getUser());
        return $this->render("ReservationBundle:Reservation:afficherReservation.html.twig",
            array(
                "re" => $reservation)
        );
    }

    public function supprimerReservationAction($id)
    {

        $re = $this->getDoctrine()->getManager();
        $reservation = $re->getRepository("ReservationBundle:Reservation")->find($id);
        $re->remove($reservation);
        $re->flush();

        return $this->redirectToRoute("ajout");


    }

    public function modifierReservationAction(Request $request)
    {
        $id = $request->get('id');
        $re = $this->getDoctrine()->getManager();
        $reservation = $re->getRepository("ReservationBundle:Reservation")->find($id);

        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $nbJours= $reservation->getDatesortie()->format(('d/m/Y')) - $reservation->getDateentree()->format(('d/m/Y'));
            $reservation->setNbrnuit($nbJours);
            $re->persist($reservation);
            $re->flush();
            return $this->redirectToRoute("aff");
        }
        return $this->render("ReservationBundle:Reservation:modifier.html.twig", array("Form" => $form->createView()));


    }

    public function paymentAction()
    {
        return $this->render('ReservationBundle:Reservation:index.html.twig');
    }

    public function generateTokenAction(Request $request)
    {
        $gateway = new Braintree_Gateway([
            'environment' => 'sandbox',
            'merchantId' => 'mtm4qrtn452m5mbk',
            'publicKey' => 'gjc7m6pz9z479sxq',
            'privateKey' => 'f3d99efa9eef1db4e2e04eebd430d14e'
        ]);

        $token = $gateway->clientToken()->generate();

        return new JsonResponse($token);
    }

    public function payment2Action(Request $request)
    {
        if ($request->get('firstName'))
            $firstname = $request->get('firstName');
        if ($request->get('lastName'))
            $lastname = $request->get('lastName');
        if ($request->get('amount'))
            $amount = $request->get('amount');
        if ($request->get('payment_method_nounce'))
            $payment_method = $request->get('payment_method_nonce');
        $gateway = new Braintree_Gateway([
            'environment' => 'sandbox',
            'merchantId' => 'mtm4qrtn452m5mbk',
            'publicKey' => 'gjc7m6pz9z479sxq',
            'privateKey' => 'f3d99efa9eef1db4e2e04eebd430d14e'
        ]);
        $result = $gateway->transaction()->sale(
            ([
                'amount' => $amount,
                'paymentMethodNonce' => 'fake-valid-nonce',
                'customer' => [
                    'firstName' => $firstname,
                    'lastName' => $lastname,
                ],
                'options' => [
                    'submitForSettlement' => true
                ]
            ]));
        return $this->render('ReservationBundle:Reservation:payment.html.twig', array('firstName' => $firstname, 'lastName' => $lastname, 'result' => $result));

    }
}

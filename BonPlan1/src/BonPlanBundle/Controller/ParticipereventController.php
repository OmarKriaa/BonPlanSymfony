<?php
/**
 * Created by PhpStorm.
 * User: Asus Pc
 * Date: 22/03/2018
 * Time: 18:33
 */

namespace BonPlanBundle\Controller;


use BonPlanBundle\Entity\Participerevent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class ParticipereventController extends Controller
{
    public function ajouterParticipationAction(Request $request)
    {

        $Participer = new Participerevent();
        $em = $this->getDoctrine()->getManager();

        $p= new EvenementController();
        $p->participerEventAction($request, $em);

        $Evenement = $em->getRepository('BonPlanBundle:Evenement')->find($request->get('idevent'));
            $Participer->setIdevent($Evenement);
            $Participer->setIdpersonne($this->getUser());
            $em->persist($Participer);
            $em->flush();

      return $this->render('BonPlanBundle:evenement:AfficherEventdetails.html.twig', array(
            'Evenement' => $Evenement
        ));
        /*
        return $this->render('BonPlanBundle:evenement:Felicitation.html.twig', array(
            'Evenement' => $Evenement
        ));*/

    }
    public function deleteAction(Request $request, $idevent)
    {
        $p= new EvenementController();
        $em = $this->getDoctrine()->getManager();
        $Evenement = $em->getRepository('BonPlanBundle:Evenement')->find($request->get('idevent'));
        $p->annulerAction($request, $em);

        return $this->render('BonPlanBundle:evenement:AfficherEventdetails.html.twig', array(
            'Evenement' => $Evenement
        ));
    }
}

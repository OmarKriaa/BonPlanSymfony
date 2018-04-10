<?php

namespace TransportBundle\Controller;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;
//use BonPlanBundle\Form\RechercherEventForm;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\JsonResponse;
use TransportBundle\Entity\Commentaire;
use TransportBundle\Entity\FosUser;
use TransportBundle\Entity\Transport;
use TransportBundle\Entity\Participation;
use TransportBundle\Form\formupdate;
use TransportBundle\Form\rechercheTransportForm;



class TransportController extends Controller
{
    public function indexAction()
    {
        return $this->render('TransportBundle:Default:index.html.twig');
    }

    public function ajouterTransportAction(Request $request)
    {
        $Transport = new Transport();

        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        if ($request->isMethod('POST')) {
            $Transport->setVilledepart($request->get('villeDepart'));
            $Transport->setVillearrive($request->get('villeArrive'));
            $Transport->setnbrplacedispo($request->get('nbrPlaceDispo'));
            $Transport->setHeuredepart($request->get('heureDepart'));
            $Transport->setHeurearrivee($request->get('heureArrivee'));
            $Transport->setIdpersonne($user);
            $date = \DateTime::createFromFormat('Y-m-d', $request->get('dateDepart'));
            $Transport->setDatedepart($date);
            $Transport->setType("covoiturage");
            $Transport->setPrixpersonne($request->get('prixPersonne'));
            $validation = 0;
            $Transport->setValidation($validation);
            $signalement = 0;
            $Transport->setSignalement($signalement);
            $today = new \DateTime();
            $today->format('Y-m-d');



            if($Transport->getVilledepart()==$Transport->getVillearrive()) {
                echo "<div class='alert alert-block alert-success'>
                    <button type='button' class='close' data-dismiss='alert'>
                        <i class='ace-icon fa fa-times'></i>
                         </button>
                        <i class='ace-icon fa fa-check green'></i>
               Vous devez selectionner deux villes   
                <strong class='red'>différentes</strong>";
            }
            elseif ($date < $today){
                echo "<div class='alert alert-block alert-success'>
                    <button  type='button' class='close' data-dismiss='alert' style='color:red' >
                        <i class='ace-icon fa fa-times' style='color: red'></i>
                         </button>
                        <i ></i>
               Transport n'est pas ajouté  ,Date  
                <strong class='red' style='color: red'>Invalide</strong>
                </div>";}
            elseif ($date > $today) {
                $twilio = $this->get('twilio.api');

                $message = $twilio->account->messages->sendMessage(
                    '+15594237456', // From a Twilio number in your account
                    '+21628059080', // Text any number
                    "Un covoiturage a été ajouté veuillez le consulter!"
                );

                //get an instance of \Service_Twilio
                $otherInstance = $twilio->createInstance('BBBB', 'CCCCC');
                $em->persist($Transport);
                $em->flush();
                echo "<div class='alert alert-block alert-success'>
                    <button type='button' class='close' data-dismiss='alert'>
                        <i class='ace-icon fa fa-times'></i>
                         </button>
                        <i class='ace-icon fa fa-check green'></i>
               Transport ajouté  avec 
                <strong class='green'>succès</strong>
                </div>";

            }


        };
        //returns an instance of Vresh\TwilioBundle\Service\TwilioWrapper


        return $this->render('TransportBundle:transport:AjouterTransport.html.twig');
    }

    public function RechercheAction(Request $request)
    {
        $transport = new Transport();
        $em = $this->getDoctrine()->getManager();
        $Form = $this->createForm(rechercheTransportForm::class, $transport);
        $Form->handleRequest($request);
        if ($Form->isSubmitted()) {
            $transport = $em->getRepository("TransportBundle:Transport")->findBy(array('villeDepart' => $transport->getVilledepart()));
        } else {
            $transport = $em->getRepository("TransportBundle:Transport")->findAll();
        }
        return $this->render("TransportBundle:transport:recherche.html.twig", array('Form' => $Form->createView(), 'Transports' => $transport));
    }

    public function afficherAction()
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $Transport = $em->getRepository('TransportBundle:Transport')->findBy(array('validation' => 1));
        return $this->render("TransportBundle:transport:AfficherTransports.html.twig",
            array(
                "Transports" => $Transport, 'user' => $user
            )
        );

    }

    public function afficherAdminAction()
    {
        $em = $this->getDoctrine()->getManager();
        $pieChart = new PieChart();

        $transport = $em->getRepository(Transport::class)->findAll();
        $total = 0;
        foreach ($transport as $Transport) {
            $total = $total + $Transport->getIdtransport();
        }
        $data = array();
        $stat = ['datedepart', 'idtransport'];
        $nb = 0;
        array_push($data, $stat);
        foreach ($transport as $classe) {
            $stat = array();
            array_push($stat, $classe->getDatedepart()->format("Y-m-d"), (($classe->getIdtransport()) * 100) / $total);
            $nb = ($classe->getIdtransport() * 100) / $total;
            $stat = [$classe->getDatedepart()->format("Y-m-d"), $nb];
            array_push($data, $stat);

        }
        $pieChart->getData()->setArrayToDataTable(
            $data);
        $pieChart->getOptions()->setTitle('Pourcentages des covoiturages dans cette date');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);
        $Transport = $em->getRepository("TransportBundle:Transport")->findAll();

        return $this->render("TransportBundle:Transport:adminAfficher.html.twig",
            array(
                "s" => $pieChart, "Transports" => $Transport
            )
        );

    }

    public function afficherdetailsAction(Request $request)
    {
        $Participation = new Participation();
        $em = $this->getDoctrine();
        $Transport = $em->getRepository('TransportBundle:Transport')->find($request->get('idtransport'));
        $em1 = $this->getDoctrine()->getManager();
        $Coms = $em->getRepository('TransportBundle:Commentaire')->findBy(array('idtransport' => $request->get('idtransport')));
        $user = $this->getUser();
        $Participation = $em->getRepository('TransportBundle:Participation')->findBy(array('idpersonne' => $this->getUser()
        , 'idtransport' => $Transport->getIdtransport()));
        return $this->render('TransportBundle:transport:AfficherTransportdelails.html.twig', array(
            "Transports" => $Transport, "user" => $user, "Participation" => $Participation, 'Coms' => $Coms
        ));
    }

    public function typeAction($ville, Request $request)
    {
        $Transport = new Transport();
        $em = $this->getDoctrine()->getManager();
        $Transport = $em->getRepository('TransportBundle:Transport')->findBy(array('validation' => 1, 'villedepart' => $ville));
        if ($request->isXmlHttpRequest()) {
            $Transport = $em->getRepository("TransportBundle:Transport")->findtransport($ville);
            $encoders = array(new XmlEncoder(), new JsonEncoder());
            $normalizers = array(new ObjectNormalizer());
            $serializer = new Serializer($normalizers, $encoders);
            $content = $serializer->serialize($Transport, 'json');
            return new JsonResponse($content);
        }
        return $this->render('TransportBundle:transport:AfficherTransportlist.html.twig', array(
            "Transports" => $Transport
        ));
    }

    public function typeAdminCovoiturageAction(Request $request)
    {
        $Transport = new Transport();
        $em = $this->getDoctrine()->getManager();
        $Transport = $em->getRepository('TransportBundle:Transport')->findBy(array('type' => "covoiturage"));
        return $this->render('TransportBundle:transport:adminAfficher.html.twig', array(
            "Transports" => $Transport
        ));
    }

    public function typeAdminTrainAction(Request $request)
    {
        $Transport = new Transport();
        $em = $this->getDoctrine()->getManager();
        $Transport = $em->getRepository('TransportBundle:Transport')->findBy(array('type' => "train"));
        $Transport->getIdtransport();
        return $this->render('TransportBundle:transport:adminAfficher.html.twig', array(
            "Transports" => $Transport
        ));
    }

    public function editAction(Request $request, $idtransport)
    {
        $em = $this->getDoctrine()->getManager();
        $Transport = $em->getRepository("TransportBundle:Transport")->find($idtransport);

        if ($request->isMethod('POST')) {
            $Transport->setVilledepart($request->get('villeDepart'));
            $Transport->setVillearrive($request->get('villeArrive'));
            $Transport->setnbrplacedispo($request->get('nbrPlaceDispo'));
            $Transport->setHeuredepart($request->get('heureDepart'));
            $Transport->setHeurearrivee($request->get('heureArrivee'));
            //$Bp->setIdpersonne($this->getUser());

            $Transport->setIdpersonne($this->getUser());
            $date = \DateTime::createFromFormat('Y-m-d', $request->get('dateDepart'));
            $Transport->setDatedepart($date);
            $Transport->setType("");
            $Transport->setPrixpersonne($request->get('prixPersonne'));

            $today = new \DateTime();
            $today->format('Y-m-d');

            $em->persist($Transport);
            $em->flush();
            $user = $this->getUser();
            $Participation = $em->getRepository('TransportBundle:Participation')->findBy(array('idpersonne' => $this->getUser()
            , 'idtransport' => $Transport->getIdtransport()));
            $Coms = $em->getRepository('TransportBundle:Commentaire')->findBy(array('idtransport' => $request->get('idtransport')));
            return $this->render('TransportBundle:transport:AfficherTransportdelails.html.twig', array(
                "Transports" => $Transport, "user" => $user, "Participation" => $Participation , 'Coms' => $Coms
            ));
        }

        return $this->render('TransportBundle:transport:updateTransport.html.twig', array('Transport' => $Transport));
    }

    public function deleteAction(Request $request, $idtransport)
    {

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('TransportBundle:Transport')->find($idtransport);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find le covoiturage .');
        }

        $em->remove($entity);
        $em->flush();

        echo "<div class='alert alert-block alert-success'>
                    <button type='button' class='close' data-dismiss='alert'>
                        <i class='ace-icon fa fa-times'></i>
                         </button>
                        <i class='ace-icon fa fa-check green'></i>
               Bon plan supprimé  avec 
                <strong class='green'>succés</strong>
                </div>";

        return $this->redirectToRoute("TransportAfficher");
    }

    public function ValiderAdminAction(Request $request, $idtransport)
    {
        $em = $this->getDoctrine()->getManager();
        $Transport = $em->getRepository("TransportBundle:Transport")->valider($idtransport);
        return $this->render('TransportBundle:Transport:adminDetails.html.twig', array(
            "Transports" => $Transport
        ));
    }

    public function SignalerAction(Request $request, $idtransport)
    {
        $Transport = new Transport();
        $em = $this->getDoctrine()->getManager();
        $Transport = $em->getRepository('TransportBundle:Transport')->find($idtransport);
        $sig = $Transport->getSignalement();
        $sig++;
        if ($sig == 3){
            $Transport->setValidation(0);
        $Transport->setSignalement($sig);}
        else $Transport->setSignalement($sig);
        $em->persist($Transport);
        $em->flush();
        $user = $this->getUser();
        $Participation = $em->getRepository('TransportBundle:Participation')->findBy(array('idpersonne' => $this->getUser()
        , 'idtransport' => $Transport->getIdtransport()));
        $Coms = $em->getRepository('TransportBundle:Commentaire')->findBy(array('idtransport' => $idtransport));
        return $this->render('TransportBundle:transport:AfficherTransportdelails.html.twig', array(
            "Transports" => $Transport, "user" => $user, "Participation" => $Participation, 'Coms' => $Coms));
    }

    public function ParticiperAction(Request $request, $idtransport)
    {
        $user = $this->getUser();
        $Transport = new Transport();
        $em = $this->getDoctrine()->getManager();
        $em1 = $this->getDoctrine()->getManager();
        $Transport = $em->getRepository('TransportBundle:Transport')->find($idtransport);
        $nbr = $Transport->getNbrPlaceDispo();
        if ($nbr == 0) {
            echo "<div class='alert alert-block alert-success'>
                    <button type='button' class='close' data-dismiss='alert'>
                        <i class='ace-icon fa fa-times'></i>
                         </button>
                        <i class='ace-icon fa fa-check green'></i>
               Desolé mais ce covoiturage est 
                <strong class='green'>complet</strong>
                </div>";

        } else {
            $Transport->setNbrPlaceDispo($Transport->getNbrPlaceDispo() - 1);
            $Participation = new Participation();
            $em = $this->getDoctrine()->getManager();
            $Participation->setIdtransport($Transport->getIdtransport());
            $Participation->setType($Transport->getType());
            $Participation->setIdpersonne($user);
            $em->persist($Transport);
            $em->flush();
            $em1->persist($Participation);
            $em1->flush();

            echo "<div class='alert alert-block alert-success'>
                    <button type='button' class='close' data-dismiss='alert'>
                        <i class='ace-icon fa fa-times'></i>
                         </button>
                        <i class='ace-icon fa fa-check green'></i>
               Votre participation a été 
                <strong class='green'>enregistré</strong>
                </div>";
        }
        $user = $this->getUser();
        $Participation = $em->getRepository('TransportBundle:Participation')->findBy(array('idpersonne' => $this->getUser()
        , 'idtransport' => $Transport->getIdtransport()));
        $Coms = $em->getRepository('TransportBundle:Commentaire')->findBy(array('idtransport' => $idtransport));

        return $this->render('TransportBundle:transport:AfficherTransportdelails.html.twig', array(
            "Transports" => $Transport, "user" => $user, "Participation" => $Participation, 'Coms' => $Coms));
    }

    public function ValiderAction(Request $request, $idtransport)
    {
        $Transport = new Transport();
        $em = $this->getDoctrine()->getManager();
        $Transport = $em->getRepository("TransportBundle:Transport")->valider($idtransport);
        return $this->redirectToRoute('AffichageCovoiturage');
    }

    public function adminAction(Request $request)
    {
        $Transport = new Transport();
        $em = $this->getDoctrine()->getManager();
        if ($request->isMethod('POST')) {
            $Transport->setVilledepart($request->get('villeDepart'));
            $Transport->setVillearrive($request->get('villeArrive'));
            $Transport->setnbrplacedispo($request->get('nbrPlaceDispo'));
            $Transport->setHeuredepart($request->get('heureDepart'));
            $Transport->setHeurearrivee($request->get('heureArrivee'));
            $Transport->setIdpersonne($this->getUser());
            $date = \DateTime::createFromFormat('Y-m-d', $request->get('dateDepart'));
            $Transport->setDatedepart($date);
            $Transport->setType("train");
            $Transport->setPrixpersonne($request->get('prixPersonne'));
            $validation = 0;
            $Transport->setValidation($validation);
            $signalement = 0;
            $Transport->setSignalement($signalement);
            $today = new \DateTime();
            $today->format('Y-m-d');

            if ($date > $today) {

                $em->persist($Transport);
                $em->flush();
                echo "<div class='alert alert-block alert-success'>
                    <button type='button' class='close' data-dismiss='alert'>
                        <i class='ace-icon fa fa-times'></i>
                         </button>
                        <i class='ace-icon fa fa-check green'></i>
               Transport ajouté  avec 
                <strong class='green'>succès</strong>
                </div>";
            } else echo "<div class='alert alert-block alert-success'>
                    <button  type='button' class='close' data-dismiss='alert' style='color:red' >
                        <i class='ace-icon fa fa-times' style='color: red'></i>
                         </button>
                        <i ></i>
               Transport n'est pas ajouté  ,Date  
                <strong class='red' style='color: red'>Invalide</strong>
                </div>";


        };
        return $this->render('TransportBundle:transport:adminAjouter.html.twig');
    }

    public function editAdminAction(Request $request, $idtransport)
    {
        $em = $this->getDoctrine()->getManager();
        $Transport = $em->getRepository("TransportBundle:Transport")->find($idtransport);

        if ($request->isMethod('POST')) {
            $Transport->setVilledepart($request->get('villeDepart'));
            $Transport->setVillearrive($request->get('villeArrive'));
            $Transport->setnbrplacedispo($request->get('nbrPlaceDispo'));
            $Transport->setHeuredepart($request->get('heureDepart'));
            $Transport->setHeurearrivee($request->get('heureArrivee'));
            //$Bp->setIdpersonne($this->getUser());

            $Transport->setIdpersonne($this->getUser());
            $date = \DateTime::createFromFormat('Y-m-d', $request->get('dateDepart'));
            $Transport->setDatedepart($date);
            $Transport->setType("");
            $Transport->setPrixpersonne($request->get('prixPersonne'));

            $today = new \DateTime();
            $today->format('Y-m-d');

            $em->persist($Transport);
            $em->flush();
            return $this->render('TransportBundle:transport:adminDetails.html.twig', array(
                "Transports" => $Transport
            ));
        }

        return $this->render('TransportBundle:transport:adminModifier.html.twig', array('Transport' => $Transport));
    }

    public function deleteAdminAction(Request $request, $idtransport)
    {

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('TransportBundle:Transport')->find($idtransport);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find le covoiturage .');
        }

        $em->remove($entity);
        $em->flush();

        echo "<div class='alert alert-block alert-success'>
                    <button type='button' class='close' data-dismiss='alert'>
                        <i class='ace-icon fa fa-times'></i>
                         </button>
                        <i class='ace-icon fa fa-check green'></i>
               Bon plan supprimé  avec 
                <strong class='green'>succés</strong>
                </div>";

        return $this->redirectToRoute("AffichageCovoiturage");
    }

    public function afficherdetailsAdminAction(Request $request)
    {
        // array('valide'=>'1')
        $em = $this->getDoctrine();
        $Transport = $em->getRepository('TransportBundle:Transport')->find($request->get('idtransport'));
        return $this->render('TransportBundle:transport:adminDetails.html.twig', array(
            "Transports" => $Transport
        ));
    }

    public function AnnulerAction(Request $request, $idtransport)
    {
        $em1 = $this->getDoctrine()->getManager();
        $Participation1 = new Participation();
        $em = $this->getDoctrine()->getManager();
        $Participation = $em->getRepository('TransportBundle:Participation')->findBy(array('idtransport' => 909));
        $Transport = $em1->getRepository('TransportBundle:Transport')->find($Participation . getIdparticipation());
        $nbr = $Transport->getNbrPlaceDispo() + 1;
        $Transport->setNbrPlaceDispo($nbr);
        // $Participation->setType("king");
        $em->remove($Participation1);
        $em->flush();

        if ($Participation != null) {
            $em1->persist($Transport);
            $em1->flush();
        }
        echo "<div class='alert alert-block alert-success'>
                    <button type='button' class='close' data-dismiss='alert'>
                        <i class='ace-icon fa fa-times'></i>
                         </button>
                        <i class='ace-icon fa fa-check green'></i>
               Votre participation a été 
                <strong class='green'>annulé</strong>
                </div>";
        return $this->redirectToRoute("TransportAfficher");
    }

    public function rechercheAjaxAction(Request $request)
    {
        $date = \DateTime::createFromFormat('Y-m-d', $request->get('datedepart'));
        $em = $this->getDoctrine()->getManager();
        $Transport = $em->getRepository("TransportBundle:Transport")
            ->findAll();
        if ($request->isMethod("POST")) {
            //echo $request->get("pays");
            if ($request->isXmlHttpRequest()) {
                $serializer = new Serializer(
                    array(
                        new ObjectNormalizer()
                    )
                );
                $Transport = $em->getRepository("TransportBundle:Transport")
                    ->findcovoiturage($request->get($date));

                //print_r($modeles);
                $data = $serializer->normalize($Transport);
                return new JsonResponse($data);
            }
        }
        return $this->render("TransportBundle:transport:adminAfficher.html.twig",
            array(
                "Transports" => $Transport
            )
        );

    }

    public function chercherAction(request $request)
    {
        $Transport = new Transport();
        $em = $this->getDoctrine()->getManager();
        $date = \DateTime::createFromFormat('Y-m-d', $request->get('date'));
        $Transport = $em->getRepository("TransportBundle:Transport")
            ->chercher($request->get('date'), $request->get('depart'), $request->get('arrivee'));
        return $this->render('TransportBundle:transport:afficherTransportlist.html.twig', array(
            "Transports" => $Transport));
    }

    public function ajouterComAction(Request $request, $idtransport)
    {

        $com = new Commentaire();
        $em = $this->getDoctrine()->getManager();
        $Transport = $em->getRepository('TransportBundle:Transport')->find($idtransport);
        if ($request->isMethod('POST')) {

            $user = $this->getUser();
            $com->setIdpersonne($user);
            $com->setChamps($request->get('commentaire'));
            $com->setIdtransport($Transport);
            $em->persist($com);
            $em->flush();
        };
        $em = $this->getDoctrine();
        $Coms = $em->getRepository('TransportBundle:Commentaire')->findBy(array('idtransport' => $idtransport));
        $user = $this->getUser();
        $Participation = $em->getRepository('TransportBundle:Participation')->findBy(array('idpersonne' => $this->getUser()
        , 'idtransport' => $Transport->getIdtransport()));
        return $this->render('TransportBundle:Transport:AfficherTransportdelails.html.twig', array(
            "Transports" => $Transport, "user" => $user, "Participation" => $Participation, 'Coms' => $Coms
        ));


    }

    public function ajaxAction(Request $request)
    {
        $em = $this->getDoctrine();
        if ($request->isXmlHttpRequest()) {
            //$serializer = new Serializer(array(new ObjectNormalizer()));
            $Transport = $em->getRepository("TransportBundle:Transport")->findtr($request->get('d'));
            return new JsonResponse(array('data' => json_encode($Transport)));
        }
        return $this->redirectToRoute("AffichageCovoiturage");
    }
    public function PieChartAction()
    {
$pieChart = new PieChart();
        $em = $this->getDoctrine();

$transport = $em->getRepository(Transport::class)->findAll();
$total = 0;
foreach ($transport as $Transport)
{
$total = $total + $Transport->getIdtransport();
}

$data = array();
$stat = ['datedepart', 'idtransport'];
$nb = 0;
array_push($data, $stat);
foreach ($transport as $classe) {
    $stat = array();
    array_push($stat, $classe->getDatedepart()->format("Y-m-d"), (($classe->getIdtransport()) * 100) / $total);
    $nb = ($classe->getIdtransport() * 100) / $total;
    $stat = [$classe->getDatedepart()->format("Y-m-d"), $nb];
    array_push($data, $stat);

}
$pieChart->getData()->setArrayToDataTable(
    $data);
$pieChart->getOptions()->setTitle('Pourcentages des covoiturages dans cette date');
$pieChart->getOptions()->setHeight(500);
$pieChart->getOptions()->setWidth(900);
$pieChart->getOptions()->getTitleTextStyle()->setBold(true);
$pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
$pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
$pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
$pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);
$Transport = $em->getRepository("TransportBundle:Transport")->findAll();
return $this->render('TransportBundle:Transport:Statistique.html.twig', array('piechart' => $pieChart));
}



}

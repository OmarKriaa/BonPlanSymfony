<?php
/**
 * Created by PhpStorm.
 * User: Asus Pc
 * Date: 21/03/2018
 * Time: 15:09
 */

namespace BonPlanBundle\Controller;

use BonPlanBundle\Entity\Evenement;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\JsonResponse;

class EvenementController extends Controller
{
    public function afficherAllEventAction()
    {
        $em = $this->getDoctrine()->getManager();
        $Evenement = $em->getREpository("BonPlanBundle:Evenement")->findAll();

        return $this->render("BonPlanBundle:evenement:AfficherEvent.html.twig",
            array(
                "Evenement" => $Evenement
            )
        );
    }
    public function ajouterAction(Request $request)
    {

        $Evenement = new Evenement();
        $em = $this->getDoctrine()->getManager();

        if ($request->isMethod('POST')) {
            $Evenement->setTitre($request->get('titre'));
            $Evenement->setPrix($request->get('prix'));
            $Evenement->setDescription($request->get('description'));
            $Evenement->setNbplace($request->get('nbPlace'));
            $Evenement->setIdpersonne($this->getUser());
            $time= \DateTime::createFromFormat('Y-m-d',$request->get('date'));
            $Evenement->setDate($time);
            $Evenement->setType($request->get('type'));
            $Evenement->setLieu($request->get('lieu'));
            $valide =0;
            $Evenement->setValide($valide);
            /// Img control
            if ($request->files->get('imageUpload')!=NULL) {
                $img=$request->files->get('imageUpload');

                $fileName = $this->generateUniqueFileName().'.'.$img->guessExtension();

                // moves the file to the directory where brochures are stored
                $img->move(
                    'images/evenement/',
                    $fileName
                );
            }else $fileName='single-evenemnt.jpg';
            $time2 = new \DateTime();
            $time2->format('Y-m-d');
            $Evenement->setImage($fileName);

            if ($time > $time2){

            $em->persist($Evenement);
            $em->flush();
            echo "<div class='alert alert-block alert-success'>
                    <button type='button' class='close' data-dismiss='alert'>
                        <i class='ace-icon fa fa-times'></i>
                         </button>
                        <i class='ace-icon fa fa-check green'></i>
               Evenemet ajouté  avec 
                <strong class='green'>succès</strong>
                </div>";
            }
            else echo "<div class='alert alert-block alert-success'>
                    <button  type='button' class='close' data-dismiss='alert' style='color:red' >
                        <i class='ace-icon fa fa-times' style='color: red'></i>
                         </button>
                        <i ></i>
               Evenemet n'est  ajouté  ,Date  
                <strong class='red' style='color: red'>Invalide</strong>
                </div>";


        };

        return $this->render('BonPlanBundle:evenement:AjouterEvent.html.twig');
    }

    public  function afficherAction()
    {
        $em = $this->getDoctrine()->getManager();
        $Evenement = $em->getREpository("BonPlanBundle:Evenement")->findAll();

        return $this->render("BonPlanBundle:evenement:AfficherEvent.html.twig",
            array(
                "Evenement" => $Evenement
            )
        );

    }
    public function afficherdetailsAction(Request $request)
    {

        $em = $this->getDoctrine();
        $Evenement = $em->getRepository('BonPlanBundle:Evenement')->find($request->get('idevent'));
        return $this->render('BonPlanBundle:evenement:AfficherEventdetails.html.twig', array(
            'Evenement' => $Evenement
        ));
    }
    public function typeAction($type,Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $Evenement = $em->getRepository('BonPlanBundle:Evenement')->findBy(array('type' => $type,'valide' => 1));

        $Recent = $em->getRepository('BonPlanBundle:Evenement')->findBy(
            array(),
            array('idevent' => 'DESC'),
            3,26
        );
            $pagination  = $this->get('knp_paginator')->paginate(
            $Evenement,
            $request->query->get('page',1),4
        );


        return $this->render('BonPlanBundle:evenement:AfficherEventlist.html.twig', array(
            'pagination' => $pagination,
            'recent' =>$Recent
        ));
    }
    public function __construct()
    {

    }

    public function participerEventAction(Request $request, EntityManager $l){

        $em = $l;
        $idevent = $request->get("idevent");

        $em->getRepository("BonPlanBundle:Evenement")->participer($idevent);
    }
    public function annulerAction(Request $request, EntityManager $l){

        $em = $l;
        $idevent = $request->get("idevent");
        $em->getRepository("BonPlanBundle:Evenement")->annuler($idevent);

    }
    //---------------Bon Planeur--------------------

    public function indexAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $Evenement = $em->getREpository("BonPlanBundle:Evenement")->findAll();
        $Recent = $em->getRepository('BonPlanBundle:Evenement')->findBy(
            array(),
            array('idevent' => 'DESC'),
            3,26
        );
        $pagination  = $this->get('knp_paginator')->paginate(
            $Evenement,
            $request->query->get('page',1),2
        );


        return $this->render('BonPlanBundle:evenement:AfficherBonPlaneur.html.twig', array(
            'pagination' => $pagination,
            'recent' =>$Recent
        ));

    }
    public function editAction(Request $request, $idevent)
    {
        $em = $this->getDoctrine()->getManager();
        $Evenement = $em->getRepository('BonPlanBundle:Evenement')->find($idevent);
        if ($request->isMethod('POST')) {
            $Evenement->setTitre($request->get('titre'));
            $Evenement->setPrix($request->get('prix'));
            $Evenement->setDescription($request->get('description'));
            $Evenement->setNbplace($request->get('nbPlace'));
            $Evenement->setIdpersonne($this->getUser());
            $time= \DateTime::createFromFormat('Y-m-d',$request->get('date'));
            $time2 = new \DateTime();
            $time2->format('Y-m-d ');
            $Evenement->setDate($time);
            $Evenement->setType($request->get('type'));
            $Evenement->setLieu($request->get('lieu'));
            $valide =1;
            $Evenement->setValide($valide);

            if ($request->files->get('imageUpload')!=NULL) {
                $img=$request->files->get('imageUpload');

                $fileName = $this->generateUniqueFileName().'.'.$img->guessExtension();

                // moves the file to the directory where brochures are stored
                $img->move(
                    'images/evenement/',
                    $fileName
                );
            }else $fileName='single-evenemnt.jpg';

            $Evenement->setImage($fileName);
            if ($time > $time2){
                $em->persist($Evenement);
                $em->flush();
                return $this->redirectToRoute("Event_Pb");
            }
            else echo "<div class='alert alert-block alert-success'>
                    <button  type='button' class='close' data-dismiss='alert' style='color:red' >
                        <i class='ace-icon fa fa-times' style='color: red'></i>
                         </button>
                        <i ></i>
               Evenemet n'est  modifier  ,Date  
                <strong class='red' style='color: red'>Invalide</strong>
                </div>";

        }

        return $this->render('BonPlanBundle:evenement:updateEvent.html.twig', array('Evenement' => $Evenement));
    }
    public function deleteAction(Request $request, $idevent)
{

    $em=$this->getDoctrine()->getManager();
    $Event=$em->getRepository("BonPlanBundle:Evenement")->find($idevent);
    $em->remove($Event);
    $em->flush();
    return $this->redirectToRoute("Event_Pb");


}
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }
    //--------------Admin---------------
    public function afficherDashAction()
    {
        $em = $this->getDoctrine()->getManager();
        $Evenement = $em->getREpository("BonPlanBundle:Evenement")->findAll();
        return $this->render("BonPlanBundle:Admin:EventDash.html.twig",
            array(
                "Evenement" => $Evenement
            )
        );
    }
    public function valideAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $idevent = $request->get("idevent");
        $Evenement = $em->getRepository("BonPlanBundle:Evenement")->valide($idevent);

        return $this->redirectToRoute("Event_Dashbord",array('Evenement' => $Evenement));
    }

    public function deleteadminAction(Request $request, $idevent)
    {
        $em=$this->getDoctrine()->getManager();
        $Event=$em->getRepository("BonPlanBundle:Evenement")->find($idevent);
        $em->remove($Event);
        $em->flush();
        return $this->redirectToRoute("Event_Dashbord");
    }
    public function ajaxAction(Request $request){
        $em=$this->getDoctrine()->getManager();
        if($request->isXmlHttpRequest()){
            //$serializer = new Serializer(array(new ObjectNormalizer()));
            $events=$em->getRepository("BonPlanBundle:Evenement")->findAjax($request->get('d'));
            return new JsonResponse(array('data' => json_encode($events)));
        }
        return $this->redirectToRoute("Event_Dashbord");
        }

}


<?php

namespace bpBundle\Controller;
use bpBundle\Entity\Com;
use bpBundle\Form\RecherchePrixType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\JsonResponse;
use bpBundle\Entity\Bonplan;
use bpBundle\Entity\FosUser;
use bpBundle\Form\RechercherBpForm;



class BpController extends Controller
{
    public function indexAction()
    {
        return $this->render('bpBundle:Default:index.html.twig');
    }

    public function ajouterAction(Request $request)
    {

        $Bp = new Bonplan();
        $em = $this->getDoctrine()->getManager();

        if ($request->isMethod('POST')) {
            $Bp->setNom($request->get('nom'));
            $Bp->setDescription($request->get('description'));
            $Bp->setAdresse($request->get('adresse'));
            $Bp->setVille($request->get('ville'));
            $type = "sejour";
            $Bp->setType($type);
            $valide = 0;
            $Bp->setValide($valide);
            $Bp->setNbreChambreDispo($request->get('nbrechambredispo'));
            $Bp->setPrixNuit($request->get('prixnuit'));
            $nbreplace = 0;
            $Bp->setNbrePlace($nbreplace);
            $user=$this->getUser();
            $Bp->setEmailPersonne($user);
            //$emailpersonne = "email@esprit.tn";
            //$Bp->setEmailPersonne($emailpersonne);

            /// Img control
            if ($request->files->get('imageUpload') != NULL) {
                $img = $request->files->get('imageUpload');

                $fileName = $this->generateUniqueFileName() . '.' . $img->guessExtension();

                // moves the file to the directory where brochures are stored
                $img->move(
                    'images/Bp/',
                    $fileName
                );
            } else $fileName = 'cabe435da48482e960de6a73552c7e51.jpeg';

            $Bp->setPhoto($fileName);
            $em->persist($Bp);
            $em->flush();
            echo "<div class='alert alert-block alert-success'>
                    <button type='button' class='close' data-dismiss='alert'>
                        <i class='ace-icon fa fa-times'></i>
                         </button>
                        <i class='ace-icon fa fa-check green'></i>
               Bon plan ajouté  avec 
                <strong class='green'>succés</strong>
                </div>";
            $twilio = $this->get('twilio.api');

            $message = $twilio->account->messages->sendMessage(
                '+15594237456', // From a Twilio number in your account
                '+21628059080', // Text any number
                " votre bon plan a été ajouté avec succés ! "
            );

            //get an instance of \Service_Twilio
            $otherInstance = $twilio->createInstance('BBBB', 'CCCCC');
        };



        return $this->render('bpBundle:bp:AjouterBp.html.twig');
    }

    public function ajouter2Action(Request $request)
    {

        $Bp = new Bonplan();
        $em = $this->getDoctrine()->getManager();

        if ($request->isMethod('POST')) {
            $Bp->setNom($request->get('nom'));
            $Bp->setDescription($request->get('description'));
            $Bp->setAdresse($request->get('adresse'));
            $Bp->setVille($request->get('ville'));
            $type = "culinaire";
            $Bp->setType($type);
            $valide = 0;
            $Bp->setValide($valide);
            $nbrechambredispo=0 ;
            $Bp->setNbreChambreDispo($nbrechambredispo);
            $prixnuit=0;
            $Bp->setPrixNuit($prixnuit);
            $Bp->setNbreplace($request->get('nbreplace'));
            $emailpersonne = "er@hmail.com";
            $Bp->setEmailPersonne($emailpersonne);

            /// Img control
            if ($request->files->get('imageUpload') != NULL) {
                $img = $request->files->get('imageUpload');

                $fileName = $this->generateUniqueFileName() . '.' . $img->guessExtension();

                // moves the file to the directory where brochures are stored
                $img->move(
                    'images/Bp/',
                    $fileName
                );
            } else $fileName = 'single-Bp.jpg';

            $Bp->setPhoto($fileName);
            $em->persist($Bp);
            $em->flush();
            echo "<div class='alert alert-block alert-success'>
                    <button type='button' class='close' data-dismiss='alert'>
                        <i class='ace-icon fa fa-times'></i>
                         </button>
                        <i class='ace-icon fa fa-check green'></i>
               Bon plan ajouté  avec 
                <strong class='green'>succés</strong>
                </div>";
        };

        return $this->render('bpBundle:bp:AjouterBp2.html.twig');
    }

    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }

    public function afficherAction()
    {
        $em = $this->getDoctrine()->getManager();
        $Bp = $em->getREpository("bpBundle:Bonplan")->findAll();

        return $this->render("bpBundle:Bp:AfficherBp.html.twig",
            array(
                "bp" => $Bp
            )
        );

    }

    public function afficherdetailsAction(Request $request)
    {
        // array('valide'=>'1')
        $em = $this->getDoctrine();
        $Bp = $em->getRepository('bpBundle:Bonplan')->find($request->get('idbonplan'));

        $em1 = $this->getDoctrine()->getManager();
        $Com = $em->getRepository('bpBundle:Com')->findBy(array('idbonplan' => $Bp->getIdbonplan()));
        $Note = $em->getRepository('PartageExperienceBundle:PartageH')->findBy(array('NomHotel' => $Bp->getIdbonplan()));

        return $this->render('bpBundle:bp:AfficherBpdetails.html.twig', array(
            'Bp' => $Bp ,'Coms' => $Com,'Note' => $Note
        ));
    }

    public function typeAction($ville, Request $request)
    {
        //$Bp = new Bonplan();
        $em = $this->getDoctrine()->getManager();
        $Bp = $em->getRepository('bpBundle:Bonplan')->findBy(array('type' => "sejour", 'valide' => 1, 'ville' => $ville));

        $form = $this->createForm(RecherchePrixType::class);
        $form->handleRequest($request);
        $PrixMin = $form['PrixMin']->getData();
        $PrixMax = $form['PrixMax']->getData();
        if ((!empty($PrixMin)) && (!empty($PrixMax))) {
            $Bp = $em->getRepository("bpBundle:Bonplan")->recherche8($PrixMax, $PrixMin);
        }
        if ((empty($PrixMin)) && (!empty($PrixMax))) {
            $Bp = $em->getRepository("bpBundle:Bonplan")->recherche12($PrixMax);
        }
        if ((!empty($PrixMin)) && (empty($PrixMax))) {
            $Bp = $em->getRepository("bpBundle:Bonplan")->recherche13($PrixMin);
        }
        $Recent = $em->getRepository('bpBundle:Bonplan')->findBy(
            array(),
            array('idbonplan' => 'DESC'),
            3,3
        );
        $pagination  = $this->get('knp_paginator')->paginate(
            $Bp,
            $request->query->get('page',1),3
        );



        // $Form = $this->createForm(RechercherBpForm::class, $Bp);
       /* if ($request->isXmlHttpRequest()) {
            $nom = $request->get('nom');
            $Bp = $em->getRepository("bpBundle:Bonplan")->findbp($nom, $ville);

            $encoders = array(new XmlEncoder(), new JsonEncoder());
            $normalizers = array(new ObjectNormalizer());
            $serializer = new Serializer($normalizers, $encoders);
            $content = $serializer->serialize($Bp, 'json');
            return new JsonResponse($content);
        }*/
        return $this->render('bpBundle:bp:AfficherBplist.html.twig', array("Form" => $form->createView(),
            'Bps' => $pagination,
            'recent' =>$Recent
        ));
    }

    public function deleteAction(Request $request, $idbonplan)
    {

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('bpBundle:Bonplan')->find($idbonplan);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find le Bon Plan .');
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

        return $this->redirectToRoute("BpAfficher");

    }

    public function editAction(Request $request, $idbonplan)
    {
        $em = $this->getDoctrine()->getManager();
        $Bp = $em->getRepository('bpBundle:Bonplan')->find($idbonplan);
        if ($request->isMethod('POST')) {
            $Bp->setNom($request->get('nom'));
            $Bp->setDescription($request->get('description'));
            $Bp->setAdresse($request->get('adresse'));
            $Bp->setVille($request->get('ville'));
            //$Bp->setIdpersonne($this->getUser());
            $type = "sejour";
            $Bp->setType($type);
            $valide = 1;
            $Bp->setValide($valide);
            $Bp->setNbreChambreDispo($request->get('nbrechambredispo'));
            $Bp->setPrixNuit($request->get('prixnuit'));
            $nbreplace = 0;
            $Bp->setNbrePlace($nbreplace);
            $emailpersonne = "er@hmail.com";
            $Bp->setEmailPersonne($emailpersonne);


            if ($request->files->get('imageUpload') != NULL) {
                $img = $request->files->get('imageUpload');

                $fileName = $this->generateUniqueFileName() . '.' . $img->guessExtension();

                // moves the file to the directory where brochures are stored
                $img->move(
                    'images/Bp/',
                    $fileName
                );
            } else $fileName = 'cabe435da48482e960de6a73552c7e51.jpeg';

            $Bp->setPhoto($fileName);
            $em->persist($Bp);
            $em->flush();
            return $this->redirectToRoute("BpAfficher");

          /*echo "<div class='alert alert-block alert-success'>
                    <button  type='button' class='close' data-dismiss='alert' style='color:red' >
                        <i class='ace-icon fa fa-times' style='color: red'></i>
                         </button>
                        <i ></i>
               Bon plan n'a pas été   
                <strong class='red' style='color: red'>modifier</strong>
                </div>";*/

    }

         return $this->render('bpBundle:bp:updateBp.html.twig', array('Bp' => $Bp ));
}

    public function ajaxAction(Request $request){
        $em=$this->getDoctrine()->getManager();
        if($request->isXmlHttpRequest()){
            //$serializer = new Serializer(array(new ObjectNormalizer()));
            $events=$em->getRepository("bpBundle:Bonplan")->findAjax($request->get('d'));
            return new JsonResponse(array('data' => json_encode($events)));
        }
        return $this->redirectToRoute("BpAfficher");
    }

    public function afficher2Action()
    {
        $em = $this->getDoctrine()->getManager();
        $Bp = $em->getREpository("bpBundle:Bonplan")->findAll();

        return $this->render("bpBundle:Bp:AfficherBp2.html.twig",
            array(
                "bp" => $Bp
            )
        );

    }

    public function afficherdetails2Action(Request $request)
    {
        // array('valide'=>'1')
        $em = $this->getDoctrine();
        $Bp = $em->getRepository('bpBundle:Bonplan')->find($request->get('idbonplan'));
        return $this->render('bpBundle:bp:AfficherBpdetails2.html.twig', array(
            'Bp' => $Bp
        ));
    }

    public function type2Action($ville, Request $request)
    {
        $Bp = new Bonplan();
        $em = $this->getDoctrine()->getManager();
        $Bp = $em->getRepository('bpBundle:Bonplan')->findBy(array('type' => "culinaire", 'valide' => 1, 'ville' => $ville));
        // $Form = $this->createForm(RechercherBpForm::class, $Bp);
        if ($request->isXmlHttpRequest()) {
            $nom = $request->get('nom');
            $Bp = $em->getRepository("bpBundle:Bonplan")->findbp($nom, $ville);

            $encoders = array(new XmlEncoder(), new JsonEncoder());
            $normalizers = array(new ObjectNormalizer());
            $serializer = new Serializer($normalizers, $encoders);
            $content = $serializer->serialize($Bp, 'json');
            return new JsonResponse($content);
        }
        return $this->render('bpBundle:bp:AfficherBplist2.html.twig', array(/*"Form" => $Form->createView(),*/
            'Bps' => $Bp
        ));
    }

    public function afficherAdminHotelAction(Request $request)
    {
        $Bp = new Bonplan();
        $em = $this->getDoctrine()->getManager();
        $Bp = $em->getRepository('bpBundle:Bonplan')->findBy(array('type' => "sejour", 'valide' => 0));
        // $Form = $this->createForm(RechercherBpForm::class, $Bp);
        if ($request->isXmlHttpRequest()) {
            $nom = $request->get('nom');
            $Bp = $em->getRepository("bpBundle:Bonplan")->findbp($nom);

            $encoders = array(new XmlEncoder(), new JsonEncoder());
            $normalizers = array(new ObjectNormalizer());
            $serializer = new Serializer($normalizers, $encoders);
            $content = $serializer->serialize($Bp, 'json');
            return new JsonResponse($content);
        }
        return $this->render('bpBundle:bp:AfficherAdminHotel.html.twig', array(/*"Form" => $Form->createView(),*/
            'Bps' => $Bp
        ));
    }

    public function afficherAdminRestoAction(Request $request)
    {
        $Bp = new Bonplan();
        $em = $this->getDoctrine()->getManager();
        $Bp = $em->getRepository('bpBundle:Bonplan')->findBy(array('type' => "culinaire", 'valide' => 0));
        // $Form = $this->createForm(RechercherBpForm::class, $Bp);
        if ($request->isXmlHttpRequest()) {
            $nom = $request->get('nom');
            $Bp = $em->getRepository("bpBundle:Bonplan")->findbp($nom);

            $encoders = array(new XmlEncoder(), new JsonEncoder());
            $normalizers = array(new ObjectNormalizer());
            $serializer = new Serializer($normalizers, $encoders);
            $content = $serializer->serialize($Bp, 'json');
            return new JsonResponse($content);
        }
        return $this->render('bpBundle:bp:AfficherAdminResto.html.twig', array(/*"Form" => $Form->createView(),*/
            'Bps' => $Bp
        ));
    }

    public function AfficherDetailAdminHotelAction (Request $request)
    {
        // array('valide'=>'1')
        $em = $this->getDoctrine();
        $Bp = $em->getRepository('bpBundle:Bonplan')->find($request->get('idbonplan'));
        return $this->render('bpBundle:bp:AfficherDetailAdminHotel.html.twig', array(
            'Bp' => $Bp
        ));
    }

    public function AfficherDetailAdminRestoAction (Request $request)
    {
        // array('valide'=>'1')
        $em = $this->getDoctrine();
        $Bp = $em->getRepository('bpBundle:Bonplan')->find($request->get('idbonplan'));
        return $this->render('bpBundle:bp:AfficherDetailAdminResto.html.twig', array(
            'Bp' => $Bp
        ));
    }

    public function ValiderAdminHotelAction(Request $request, $idbonplan)
    {
        $Bp = new Bonplan();
        $em = $this->getDoctrine()->getManager();
        $Bp = $em->getRepository("bpBundle:Bonplan")->valider($idbonplan);
        return $this->redirectToRoute("AfficherAdminH");
    }

    public function AnnulerHotelAction(Request $request, $idbonplan)
    {

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('bpBundle:Bonplan')->find($idbonplan);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find le Bon Plan .');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirectToRoute("AfficherAdminH");

    }

    public function ValiderAdminRestoAction(Request $request, $idbonplan)
    {
        $Bp = new Bonplan();
        $em = $this->getDoctrine()->getManager();
        $Bp = $em->getRepository("bpBundle:Bonplan")->valider($idbonplan);
        return $this->redirectToRoute("AfficherAdminR");
    }

    public function AnnulerRestoAction(Request $request, $idbonplan)
    {

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('bpBundle:Bonplan')->find($idbonplan);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find le Bon Plan .');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirectToRoute("AfficherAdminR");

    }

    public function ajouterComAction(Request $request,$idbonplan)
    {

        $com = new Com();
        $em = $this->getDoctrine()->getManager();
        $BP = $em->getRepository('bpBundle:Bonplan')->find($idbonplan);
        if ($request->isMethod('POST')) {

            $user=$this->getUser();
            $com->setIdpersonne($user);
            $com->setCommentaire($request->get('commentaire'));
            $com->setIdbonplan($BP);
            $em->persist($com);
            $em->flush();
        };
        $em = $this->getDoctrine();
        $Bp = $em->getRepository('bpBundle:Bonplan')->find($idbonplan);
        $Coms = $em->getRepository('bpBundle:Com')->findBy(array('idbonplan' => $idbonplan));
        $Note = $em->getRepository('PartageExperienceBundle:PartageH')->findBy(array('NomHotel' => $Bp->getIdbonplan()));

        return $this->render('bpBundle:bp:AfficherBpdetails.html.twig', array(
            'Bp' => $Bp ,'Coms' => $Coms,'Note' => $Note
        ));


    }

    public function afficherAdminTousAction(Request $request)
    {
        $Bp = new Bonplan();
        $em = $this->getDoctrine()->getManager();
        $Bp = $em->getRepository('bpBundle:Bonplan')->findBy(array('type' => "sejour", 'valide' => 1));
        // $Form = $this->createForm(RechercherBpForm::class, $Bp);
        if ($request->isXmlHttpRequest()) {
            $nom = $request->get('nom');
            $Bp = $em->getRepository("bpBundle:Bonplan")->findbp($nom);

            $encoders = array(new XmlEncoder(), new JsonEncoder());
            $normalizers = array(new ObjectNormalizer());
            $serializer = new Serializer($normalizers, $encoders);
            $content = $serializer->serialize($Bp, 'json');
            return new JsonResponse($content);
        }
        return $this->render('bpBundle:bp:AfficherAdminH.html.twig', array(/*"Form" => $Form->createView(),*/
            'Bps' => $Bp
        ));
    }







}


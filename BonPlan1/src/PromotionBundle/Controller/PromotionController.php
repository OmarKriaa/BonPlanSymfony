<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 26/03/2018
 * Time: 10:44
 */

namespace PromotionBundle\Controller;


use PromotionBundle\Entity\Promotion;
use PromotionBundle\Form\PromotionType;
use PromotionBundle\Form\RecherchePromotionType;
use Skies\QRcodeBundle\DineshBarcode\QRcode;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use PromotionBundle\Repository\PromotionRepository;


class PromotionController extends Controller
{
    public function PromotionAction()
    {

        return $this->render('PromotionBundle:Promotion:Promotion.html.twig');

    }



    public function AjoutPromotionAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $Promotion = new Promotion();
        $form = $this->createForm(PromotionType::class,$Promotion);
        $form->handleRequest($request);


         if ($form->isValid()) { // suite au clic sur le bouton
             $qr = $form['QRCode']->getData();
//->rechQR($qr);
             $existing = $em->getRepository("PromotionBundle:Promotion")->findOneBy(array('QRCode'=>$qr));
            if (empty($existing))
            {

                $file = $Promotion->getImage();
                $filename = md5(uniqid()) . '.' . $file->guessExtension();
                $file->move($this->getParameter('image_directory'), $filename);
                $Promotion->setImage($filename);


                $em->persist($Promotion);
                $em->flush();
                return $this->redirectToRoute("AffichePromotion");
            }
else
    {
        echo '<script type="text/javascript">' . 'alert("Erreur : Qrcode existant .. veuillez saisir un nouveau QRCode");' . '</script>';

}
             return $this->render('PromotionBundle:Promotion:Promotion.html.twig', array(

                 "form" => $form->createView()

             ));

         }



        return $this->render('PromotionBundle:Promotion:Promotion.html.twig', array(

            "form" => $form->createView()

        ));
    }
    public function AffichePromotionAction()
    {
        $em = $this->getDoctrine()->getManager();
        $Promotion= $em->getRepository('PromotionBundle:Promotion')->findAll();
        return $this->render('PromotionBundle:Promotion:AffichePromotion.html.twig', array(
            "Promotions" => $Promotion));

    }
    public function ModifierPromotionAction(Request $request)
    {
        $id=$request->get("id");
        $em=$this->getDoctrine()->getManager();
        $Promotion=$em->getRepository("PromotionBundle:Promotion")->find($id);
        $form = $this->createForm(PromotionType::class,$Promotion);
        $form->handleRequest($request);
        if($form->isValid()){ // suite au clic sur le bouton


            $em->persist($Promotion);
            $em->flush();
            return $this->redirectToRoute("AffichePromotion");

        }
        return $this->render('PromotionBundle:Promotion:ModifierPromotion.html.twig',array(

            "Form" => $form->createView()

        ));
    }

    public function SupprimerPromotionAction($id){

        $em=$this->getDoctrine()->getManager();
        $Promotion=$em->getRepository("PromotionBundle:Promotion")->find($id);
        $em->remove($Promotion);
        $em->flush();

        return $this->redirectToRoute("AffichePromotion");
    }

    public function AfficherPromotionsAction()
    {
        /*
        $em = $this->getDoctrine()->getManager();
        $Promotion= $em->getRepository('PromotionBundle:Promotion')->findAll();
        return $this->render('PromotionBundle:Promotion:AfficherPromotions.html.twig', array(
            "Promotions" => $Promotion));*/

    }
    public function DetailsAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $Promotion = $em->getRepository("PromotionBundle:Promotion")->findBy(array('id' => $id));
/*
        $options = array(
            'code'   => 'Votre code est 2793 jusqu au 31/03/2018',
            'type'   => 'qrcode',
            'format' => 'svg',
            'width'  => 10,
            'height' => 10,
            'color'  => 'green',
        );

        $barcode =
            $this->get('skies_barcode.generator')->generate($options);

        return new Response($barcode);
        $savePath = '/Uploads/';
        $fileName = 'sample.svg';

        file_put_contents($savePath.$fileName, $barcode);
*/
        return $this->render('PromotionBundle:Promotion:Details.html.twig', array(
            "Promo" => $Promotion));
    }

    public function RecherchePromotionAction (Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $Promotion= $em->getRepository('PromotionBundle:Promotion')->findAll();

        $form = $this->createForm(RecherchePromotionType::class);
        $form->handleRequest($request);
        $PrixMin = $form['PrixMin']->getData();
        $PrixMax = $form['PrixMax']->getData();



        if ((!empty($PrixMin)) && (!empty($PrixMax))) {
            $Promotion = $em->getRepository("PromotionBundle:Promotion")->recherche8($PrixMax, $PrixMin);
        }
        if ((empty($PrixMin)) && (!empty($PrixMax))) {
            $Promotion = $em->getRepository("PromotionBundle:Promotion")->recherche12($PrixMax);
        }
        if ((!empty($PrixMin)) && (empty($PrixMax))) {
            $Promotion = $em->getRepository("PromotionBundle:Promotion")->recherche13($PrixMin);
        }


        return $this->render('PromotionBundle:Promotion:AfficherPromotions.html.twig', array('v' => $Promotion, 'form' => $form->createView()));
    }


    public function AfficherDashBoardAction()
    {
        $em = $this->getDoctrine()->getManager();
        $Promotion = $em->getRepository("PromotionBundle:Promotion")->findAll();
        return $this->render("BonPlanBundle:Admin:PromotionDash.html.twig",
            array(
                "Promotion" => $Promotion
            )
        );
    }

    public function valideAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $idPromotion = $request->get("id");
        $Promotion = $em->getRepository("PromotionBundle:Promotion")->valide($idPromotion);

        return $this->redirectToRoute("AfficherPromotionDash",array('Promotion' => $Promotion));
    }



}
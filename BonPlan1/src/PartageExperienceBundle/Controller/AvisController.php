<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 21/03/2018
 * Time: 12:52
 */

namespace PartageExperienceBundle\Controller;


use PartageExperienceBundle\Form\PartageHType;
use PartageExperienceBundle\Form\RechercheAjax;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use PartageExperienceBundle\Entity\PartageH;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;


use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AvisController extends Controller
{
    public function AvisAction()
    {

        return $this->render('PartageExperienceBundle:Avis:PartageAvis.html.twig');

    }

    public function AjouterAvisAction(Request $request)
    {
        $PartageH = new PartageH();
        $form = $this->createForm(PartageHType::class,$PartageH);

        $form->handleRequest($request);

            if ($form->isValid())
            { // suite au clic sur le bouton

                $em = $this->getDoctrine()->getManager();

                $PartageH->setDateCommentaireH(new \Datetime('today'));

                $em->persist($PartageH);
                $em->flush();
                echo "<div class='alert alert-block alert-success'>
                    <button type='button' class='close' data-dismiss='alert'>
                        <i class='ace-icon fa fa-times'></i>
                         </button>
                        <i class='ace-icon fa fa-check green'></i>
               Avis ajouté avec 
                <strong class='green'>succès</strong>
                </div>";
               // return $this->redirectToRoute("Avis");

            }

            return $this->render('PartageExperienceBundle:Avis:PartageAvis.html.twig', array(

                "form" => $form->createView()

            ));


    }

    public function ListAvisAction()
    {
        $em = $this->getDoctrine()->getManager();
        $PartageH = $em->getRepository('PartageExperienceBundle:PartageH')->findAll();
        return $this->render('PartageExperienceBundle:Avis:PartageAvis.html.twig', array(
            "partages" => $PartageH));

    }

    public function ModifierPartageAction(Request $request)
    {
        $id=$request->get("idPartageH");
        $em=$this->getDoctrine()->getManager();
        $PartageH=$em->getRepository("PartageExperienceBundle:PartageH")->find($id);
        $form = $this->createForm(PartageHType::class,$PartageH);
        $form->handleRequest($request);
        if($form->isValid()){ // suite au clic sur le bouton


            $em->persist($PartageH);
            $em->flush();
            return $this->redirectToRoute("List");

        }
        return $this->render('PartageExperienceBundle:Avis:modifier.html.twig',array(

            "Form" => $form->createView()

        ));
    }
    public function SupprimerPartageAction($idPartageH){

        $em=$this->getDoctrine()->getManager();
        $PartageH=$em->getRepository("PartageExperienceBundle:PartageH")->find($idPartageH);
        $em->remove($PartageH);


        $em->flush();

        return $this->redirectToRoute("recherche_ajax");
    }

    public function rechercheAjaxAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $partageh = $em->getRepository("PartageExperienceBundle:PartageH")
            ->findAll();


        if ($request->isMethod("POST")) {
            //echo $request->get("pays");
            if ($request->isXmlHttpRequest()) {
                $serializer = new Serializer(
                    array(
                        new ObjectNormalizer()
                    )
                );
                $partageh = $em->getRepository("PartageExperienceBundle:PartageH")
                    ->findSerieDQL($request->get('DateCommentaireH'));

                //print_r($modeles);
                $data = $serializer->normalize($partageh);
                return new JsonResponse($data);
            }
        }
        return $this->render("PartageExperienceBundle:Avis:PartageAvis.html.twig",
            array(
                "P" => $partageh
            )
        );

    }

    public function PieChartAction()
    {
        $em = $this->getDoctrine()->getManager();
        /* return $this->render('BonPlanBundle:Admin:Contact.html.twig',array(
             'contact'=>$Contact));*/


        $pieChart = new PieChart();
        $em = $this->getDoctrine();
        $partage = $em->getRepository(PartageH::class)->findAll();
        $total = 0;
        foreach ($partage as $partages) {
            $total = $total + $partages->getidPartageH();
        }
        $data = array();
        $stat = ['name', 'id'];
        $nb = 0;
        array_push($data, $stat);
        foreach ($partage as $classe) {
            $stat = array();
            array_push($stat, $classe->getDateCommentaireH()->format("Y-m-d"), (($classe->getidPartageH()) * 100) / $total);
            $nb = ($classe->getidPartageH() * 100) / $total;
            $stat = [$classe->getDateCommentaireH()->format("Y-m-d"), $nb];
            array_push($data, $stat);

        }
        $pieChart->getData()->setArrayToDataTable(
            $data);
        $pieChart->getOptions()->setTitle('Pourcentages de Personnes qui ont Commenté');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);

        return $this->render('PartageExperienceBundle:Avis:Statistique.html.twig', array('piechart' => $pieChart));

    }




}
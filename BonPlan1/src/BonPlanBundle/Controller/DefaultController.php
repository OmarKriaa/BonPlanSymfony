<?php

namespace BonPlanBundle\Controller;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use PartageExperienceBundle\Form\ContactType;
use ReservationBundle\Entity\Reservation;
use ReservationBundle\Form\chercherType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PartageExperienceBundle\Entity\Contact;
use Symfony\Component\HttpFoundation\Request;
use Ob\HighchartsBundle\Highcharts\Highchart;


class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('BonPlanBundle:Default:index.html.twig');
    }

    public function DashBoardAction()
    {
        return $this->render('BonPlanBundle:Default:index2.html.twig');
    }

    public function ContactAdminAction()
    {
        return $this->render('BonPlanBundle:Admin:Contact.html.twig');
    }

    public function ListContactsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $Contact = $em->getRepository('PartageExperienceBundle:Contact')->findAll();
       /* return $this->render('BonPlanBundle:Admin:Contact.html.twig',array(
            'contact'=>$Contact));*/


        $pieChart = new PieChart();
        $em = $this->getDoctrine();
        $contact = $em->getRepository(Contact::class)->findAll();
        $total = 0;
        foreach ($contact as $contacts) {
            $total = $total + $contacts->getId();
        }
        $data = array();
        $stat = ['DateCommentaire', 'id'];
        $nb = 0;
        array_push($data, $stat);
        foreach ($contact as $classe) {
            $stat = array();
            array_push($stat, $classe->getDateCommentaire()->format('Y-m-d'), (($classe->getId()) * 100) / $total);
            $nb = ($classe->getId() * 100) / $total;
            $stat = [$classe->getDateCommentaire()->format('Y-m-d'), $nb];
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

        return $this->render('BonPlanBundle:Admin:Contact.html.twig', array('piechart' => $pieChart,'contact'=>$Contact));

    }

    public function ModifierContactAction(Request $request)
    {
        $id=$request->get("id");
        $em=$this->getDoctrine()->getManager();
        $Contact=$em->getRepository("PartageExperienceBundle:Contact")->find($id);
        $form = $this->createForm(ContactType::class,$Contact);
        $form->handleRequest($request);
        if($form->isValid()){ // suite au clic sur le bouton


            $em->persist($Contact);
            $em->flush();
            return $this->redirectToRoute("ContactAdmin");

        }
        return $this->render('BonPlanBundle:Admin:Modifier.html.twig',array(

            "Form" => $form->createView()

        ));
    }

    public function SupprimerContactAction($id){

        $em=$this->getDoctrine()->getManager();
        $Contact=$em->getRepository("PartageExperienceBundle:Contact")->find($id);
        $em->remove($Contact);
        $em->flush();

        return $this->redirectToRoute("ContactAdmin");
    }

    public function profitsHistoryAction()
    {
        $em = $this->getDoctrine()->getManager();
        $reservation = array('');
        $date = array('');
        $re = $em->getRepository('ReservationBundle:Reservation')->aa();
        // Chart
        foreach ($re as $x) {
            array_push( $reservation , $x->getDateentree()->format(('d/m/Y')));
        }
        foreach ($re as $x) {
            array_push( $date , $x->getNbrchambre());
        }

        $series = array(  array("" => "","data" => $date)
        );

        $ob = new Highchart();
        $ob->chart->renderTo('linechart');  // The #id of the div where to render the chart
        $ob->chart->type('column');
        $ob->title->text('Les reservations');
        $ob->xAxis->title(array('text'  => "reservation"));
        $ob->xAxis->categories($reservation);
        $ob->yAxis->title(array('text'  => "nombre de chambres"));
        $ob->yAxis->categories($date);
        $ob->series($series);

        return $this->render('BonPlanBundle:Admin:stat.html.twig' , array(
            'chart' => $ob
        ));

    }
    public function affAction(Request $request)
    {
        $reservation=new Reservation();
        $re= $this->getDoctrine()->getManager();
        $Form=$this->createForm(chercherType::class,$reservation);
        $Form->handleRequest($request);
        if($Form->isValid()){
            $reservation=$re->getRepository("ReservationBundle:Reservation")->findBy(array('dateentree'=>$reservation->getDateentree()));
        }else{
            $reservation=$re->getRepository("ReservationBundle:Reservation")->findAll();
        }
        return $this->render("BonPlanBundle:Admin:afficherReservation.html.twig",array("Form"=>$Form->createView(),'re'=>$reservation));
    }

    public function afficherReclamationAction(Request $request)
    {
        $re = $this->getDoctrine()->getManager();
        $reclamation = $re->getRepository("ReservationBundle:Reclamation")
            ->findAll();
        return $this->render("BonPlanBundle:Admin:afficherReclamation.html.twig",
            array(
                "re" => $reclamation)
        );
    }
    public function mailAction( \Swift_Mailer $mailer)
    {

        $message = (new \Swift_Message('Hello Email'))
            ->setFrom('sami.mefteh@esprit.tn')
            ->setTo('mohamed.bayoudh@esprit.tn')
            ->setBody("dfghjk");




        $mailer->send($message);

        return $this->render('BonPlanBundle:Default:index.html.twig');
    }

}

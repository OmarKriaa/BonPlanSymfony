<?php
/**
 * Created by PhpStorm.
 * User: esprit
 * Date: 11/03/2018
 * Time: 13:26
 */

namespace TransportBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class rechercheTransportForm extends AbstractType
{
     public function buildForm(FormBuilderInterface $builder, array $options)
     {
        $builder
             ->add('villeDepart')
             ->add('Valider',SubmitType::class);

     }
     public function  configureOptions(OptionsResolver $resolver)
     {
     }
     public function getName()
     {
         return 'transport_bundlerecherche_transport_form';
     }
}
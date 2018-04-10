<?php
/**
 * Created by PhpStorm.
 * User: esprit
 * Date: 27/03/2018
 * Time: 20:51
 */

namespace TransportBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormTypeInterface;

class formupdate extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
         $builder
             ->add('villeDepart')
             ->add('villeArrive')
             ->add('nbrPlaceDispo')
             ->add('heureDepart')
             ->add('heureArrivee')
             ->add('prixPersonne')
             //->add('dateDepart')
             ->add('Valider',SubmitType::class);

    }
    public function  configureOptions(OptionsResolver $resolver)
    {
    }
    public function getName()
    {
        return 'transport_bundletransport_type';

    }
}
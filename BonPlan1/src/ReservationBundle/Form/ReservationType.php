<?php

namespace ReservationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ReservationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateentree',DateType::class, array(
                // renders it as a single text box
                'widget' => 'single_text','label' => 'Votre date de entree', 'required' => true,
            ))
            ->add('datesortie',DateType::class, array('label' => 'Votre date de sortie', 'required' => true,'widget' => 'single_text',))
            ->add('type',ChoiceType::class,array('choices'=>array('demi pension'=>'demi pension','pension complete'=>'pension complete')))
            ->add('nbrchambre')

            ->add('ajouter',SubmitType::class);


    }/**
 * {@inheritdoc}
 */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ReservationBundle\Entity\Reservation'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'reservationbundle_reservation';
    }


}

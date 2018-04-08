<?php

namespace PartageExperienceBundle\Form;

use blackknight467\StarRatingBundle\Form\RatingType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PartageHType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('note_service_h',RatingType::class)
            ->add('note_rapport_h',RatingType::class,[
                'label' => 'Note Rapport'])
            ->add('note_confort_h',RatingType::class,[
        'label' => 'Note Confort'])
            ->add('note_personnel_h',RatingType::class,[
        'label' => 'Note Personnel'])
            ->add('commentaire_avis_h',TextType::class,[
        'label' => 'Commentaire'])
            ->add('NomHotel',EntityType::class,array(
                'class'=>'BonPlanBundle:Bonplan',
                'choice_label'=>'nom',
                'multiple'=>false
            ))

            ->add('Ajouter',SubmitType::class);

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PartageExperienceBundle\Entity\PartageH'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'partageexperiencebundle_partageh';
    }

    public function getName()
    {
        return 'PartageH';
    }


}

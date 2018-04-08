<?php

namespace PromotionBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PromotionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre',TextType::class,[
                'label' => 'Titre'])
            ->add('description',TextType::class,[
                'label' => 'Description'])
            ->add('lieu',TextType::class,[
                'label' => 'Lieu'])
            ->add('image',FileType::class,array(
                'label'=>'insert image'))
            ->add('dateFin',DateType::class,array(
                // renders it as a single text box
                'widget' => 'single_text',))
            ->add('prix',NumberType::class,[
                'label' => 'Prix'])
            ->add('QRCode',TextType::class,[
                'label' => 'QRCode'])
            ->add('ValeurReduction',EntityType::class,array(
                'class'=>'PromotionBundle:Reduction',
                'choice_label'=>'Valeur',
                'multiple'=>false
            ))
            ->add('Ajouter',SubmitType::class);

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PromotionBundle\Entity\Promotion'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'promotionbundle_promotion';
    }


}

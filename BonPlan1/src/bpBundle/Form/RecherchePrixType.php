<?php
/**
 * Created by PhpStorm.
 * User: senda
 * Date: 04/04/2018
 * Time: 10:35 AM
 */

namespace bpBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class RecherchePrixType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('PrixMin', TextType::class, array('label' => 'PrixMin', 'attr' => array('class' => 'form-control'), 'required' => false))
            ->add('PrixMax', TextType::class, array('label' => 'PrixMax', 'attr' => array('class' => 'form-control'), 'required' => false))
            ->add('Recherche', SubmitType::class);
    }
}
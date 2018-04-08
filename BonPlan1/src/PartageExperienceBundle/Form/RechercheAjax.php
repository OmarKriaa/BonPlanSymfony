<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 27/03/2018
 * Time: 22:31
 */

namespace PartageExperienceBundle\Form;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;

class RechercheAjax extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date_commentaire_h',DateType::class, array(
                // renders it as a single text box
                'widget' => 'single_text','label' => 'Date Commentaire'))
            ->add('Rechercher',SubmitType::class);
    }
    public function configureOptions(OptionsResolver $resolver)
    {

    }
    public function getName()
    {
        return 'PartageExperienceBundleRecherche_Ajax_form';
    }
}

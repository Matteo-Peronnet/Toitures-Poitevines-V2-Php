<?php

namespace BackOfficeBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DevisType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('numero',NumberType::class,array('label' => false, 'required' => true))
                ->add('prixHT',NumberType::class,array('label' => false, 'required' => true))
                ->add('prixTTC',NumberType::class,array('label' => false, 'required' => true))
                ->add('tva', ChoiceType::class, array(
                    'choices' => array(
                        '10%' => 10,
                        '20%' => 20
                    ),
                    'required'    => true,
                    'empty_data'  => null,
                    'label' => false
                ))
                ->add('information',TextareaType::class,array('label' => false, 'required' => true))
                ->add('chantier',TextType::class,array('label' => false, 'required' => true))
                ->add('date',DateType::class,array('label' => false, 'required' => true))
                ->add('client',EntityType::class,array(
                    'class'=>"BackOfficeBundle:Client",
                    'choice_label'=>'UniqueName',
                    'label' => false,
                    'required' => true
                    ))
                ->add('entreprise',EntityType::class,array(
                    'class'=>"BackOfficeBundle:Entreprise",
                    'choice_label'=>'nom',
                    'label' => false,
                    'required' => true
                ))
                ->add('save',SubmitType::class);;
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BackOfficeBundle\Entity\Devis'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'backofficebundle_devis';
    }


}

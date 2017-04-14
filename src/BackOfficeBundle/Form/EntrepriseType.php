<?php

namespace BackOfficeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntrepriseType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class,array('label' => false))
            ->add('siege',TextType::class,array('label' => false))
            ->add('email',TextType::class,array('label' => false))
            ->add('telephone',TextType::class,array('label' => false))
            ->add('coGerants',TextType::class,array('label' => false))
            ->add('sarl',TextType::class,array('label' => false))
            ->add('siret',TextType::class,array('label' => false))
            ->add('tva',TextType::class,array('label' => false))
            ->add('save',SubmitType::class)
            ->add('cancel',ResetType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BackOfficeBundle\Entity\Entreprise'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'backofficebundle_entreprise';
    }


}

<?php

namespace BackOfficeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom',TextType::class,array('label' => false, 'required' => true))
                ->add('prenom',TextType::class,array('label' => false, 'required' => true))
                ->add('ville',TextType::class,array('label' => false, 'required' => true))
                ->add('adresse',TextType::class,array('label' => false, 'required' => true))
                ->add('codePostal',NumberType::class,array('label' => false, 'required' => true))
                ->add('telephone',TextType::class,array('label' => false, 'required' => false))
                ->add('email',EmailType::class,array('label' => false, 'required' => false))
                ->add('cancel',ResetType::class)
                ->add('save',SubmitType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BackOfficeBundle\Entity\Client'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'backofficebundle_client';
    }


}

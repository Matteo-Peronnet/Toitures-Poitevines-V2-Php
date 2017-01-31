<?php

namespace BackOfficeBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LigneDevisType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('categorie',EntityType::class,array(
                'class'=>"BackOfficeBundle:Categorie",
                'choice_label'=>'nom',
                'label' => false,
                'mapped' => false
            ))
                ->add('quantite',NumberType::class,array('label' => false, 'required' => true))
                ->add('produit',EntityType::class,array(
                    'class'=>"BackOfficeBundle:Produit",
                    'choice_label'=>'nom',
                    'label' => false,
                    'required' => true
                ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BackOfficeBundle\Entity\LigneDevis'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'backofficebundle_lignedevis';
    }


}

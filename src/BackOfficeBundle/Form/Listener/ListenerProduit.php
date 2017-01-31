<?php

namespace BackOfficeBundle\Form\Listener;

use BackOfficeBundle\Entity\Produit;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class ListenerProduit implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            FormEvents::POST_SET_DATA => 'onPreSetData',
            FormEvents::PRE_SUBMIT=> 'onPreSubmit',
        ];
    }

    public function onPreSetData(FormEvent $event)
    {

        //$id = $event->getData()->getChampionnat() !== null ? $event->getData()->getChampionnat()->getId(): null;
        $id = 10;
        $this->addModifier($event->getForm(), $id);
    }
    public function onPreSubmit(FormEvent $event)
    {
        $this->addModifier($event->getForm(), $event->getData()["categorie"]);
    }
    public function addModifier(FormInterface $form, $categorie_id = null)
    {
        $form->add('produit', EntityType::class, array(
            'class'       => Produit::class,
            'label' => false,
            'required' => true,
            "query_builder"=>function(EntityRepository $repo) use ($categorie_id) {
                return
                    $repo->createQueryBuilder("p")
                        ->innerJoin("p.categorie", "c")
                        ->andWhere("c.id = :categorie_id")
                        ->setParameter("categorie_id", $categorie_id);
            }
        ));
    }
}
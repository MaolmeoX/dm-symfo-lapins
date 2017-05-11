<?php

namespace AppBundle\Form;

use AppBundle\Repository\DocteurRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

use Symfony\Component\Form\FormInterface;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use AppBundle\Entity\Client;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;

class RendezVousType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateType::class, array(
                'widget' => 'single_text',
                'html5' => true,
            ));

        $builder
            ->add('client', EntityType::class, array(
                'class' => 'AppBundle:Client',
                'placeholder' => 'Sélectionner un client',
            ));

        $formModifier = function (FormInterface $form, Client $client = null) {

            $idEspece = null === $client ? 0 : $client->getEspece()->getId();

            $form->add('docteur', EntityType::class, array(
                'class' => 'AppBundle:Docteur',
                'placeholder' => 'Sélectionner un docteur',
                'query_builder' => function (DocteurRepository $er) use ($idEspece) {
                    return $er->getByClientEspece($idEspece);
                },
            ));
        };

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier) {
                $rendezVous = $event->getData();
                $form = $event->getForm();
                $formModifier($event->getForm(), $rendezVous->getClient());

                if (!$rendezVous || null != $rendezVous->getId()) {
                    $form->add('isComing')->add('maladie');
                }
            }
        );

        $builder->get('client')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                $client = $event->getForm()->getData();

                $formModifier($event->getForm()->getParent(), $client);
            }
        );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\RendezVous'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_rendezvous';
    }


}

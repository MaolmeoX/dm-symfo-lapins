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
            ))
            ->add('maladie');

        $builder
            ->add('client', EntityType::class, array(
                'class' => 'AppBundle:Client',
                'placeholder' => '',
            ));

        $formModifier = function (FormInterface $form, Client $client = null) {

            if($client === null){
                $idEspece = 113;
            }else {
                $idEspece = $client;
            }

            $form->add('docteur', EntityType::class, array(
                'class' => 'AppBundle:Docteur',
                'placeholder' => '',
                'query_builder' => function (DocteurRepository $er) use($idEspece) {
                    return $er->getByClientEspece($idEspece);
                },
            ));
        };

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier) {
                // this would be your entity, i.e. SportMeetup
                $data = $event->getData();
dump($data->getClient());
                $formModifier($event->getForm(), $data->getClient());
            }
        );

        $builder->get('client')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                // It's important here to fetch $event->getForm()->getData(), as
                // $event->getData() will get you the client data (that is, the ID)
                $client = $event->getForm()->getData();

                // since we've added the listener to the child, we'll have to pass on
                // the parent to the callback functions!
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

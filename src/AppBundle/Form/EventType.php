<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


use AppBundle\Entity\Band;
use AppBundle\Entity\ConcertHall;
use AppBundle\Entity\Event;
use AppBundle\Entity\User;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class EventType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('name', TextType::class)
        ->add('description', TextType::class)

        ->add('stratTime', DateTimeType::class,[
                'placeholder' => 'Select a value' 
            ])
        ->add('endTime', DateTimeType::class,[
                'placeholder' => [
                     'month' => 'Month', 'day' => 'Day', 'year' => 'Year',
                    'hour' => 'Hour', 'minute' => 'Minute',
                    ] 
            ])
        ->add('bands',EntityType::class,[
                    'class' => 'AppBundle:Band',
                    'choice_label' => 'name',
                    'multiple' => true,
                    'expanded' => true
                ])
        ->add('concertHall')
        ->add('save', SubmitType::class);       
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Event'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_event';
    }


}

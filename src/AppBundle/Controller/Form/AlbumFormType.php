<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

use AppBundle\Entity\Band;
use AppBundle\Entity\Tags;
use AppBundle\Entity\Album;



class AlbumFormType extends AbstractType {

	public function buildForm(FormBuilderInterface $builder, array $options) {
			$builder
				->add('name')
				->add('description')
			;
	}

	public function configureOptions(OptionsResolver $resolver) {

		$resolver->setDefaults([
			'data_class'=>'AppBundle\Entity\Album'
			]);

	} 
}
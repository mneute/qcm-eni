<?php

namespace Eni\MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class QuestionType extends AbstractType {

	public function getName() {
		return 'question';
	}

	public function buildForm(FormBuilderInterface $oBuilder, array $tOptions) {
		$oBuilder
				->add('enonce', 'text', ['label' => 'Énoncé', 'max_length' => 255])
				->add('theme', 'entity', [
					'class' => 'MainBundle:Theme',
					'property' => 'libelle',
					'label' => 'Thème',
					'empty_value' => 'Veuillez choisir un thème ...'
				])
//				->add('media')
				->add('reponsesProposees', 'collection', [
					'type' => new ReponseProposeeType(),
					'allow_add' => true,
					'allow_delete' => true,
					'by_reference' => false
				])
		;
	}

	public function setDefaultOptions(OptionsResolverInterface $oResolver) {
		$oResolver->setDefaults([
			'data_class' => 'Eni\MainBundle\Entity\Question'
		]);
	}
}

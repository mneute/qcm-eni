<?php

namespace Eni\MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class QuestionType extends AbstractType {

	public function getName() {
		return 'question';
	}

	public function buildForm(FormBuilderInterface $oBuilder, array $tOptions) {
		$oBuilder
				->add('enonce', 'text', ['label' => 'Enonce', 'max_legnth' => 255])
				->add('theme', 'entity', [
					'class' => 'Mainbundle:Theme',
					'property' => 'libelle',
					'label' => 'Thème'
				])
				->add('media');
	}
}

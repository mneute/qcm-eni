<?php

namespace Eni\MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class TestType extends AbstractType {

	public function getName() {
		return 'test';
	}

	public function buildForm(FormBuilderInterface $oBuilder, array $tOptions) {
		$oBuilder
				->add('libelle', 'text', [
					'label' => 'Libellé',
					'max_length' => 255
				])
				->add('description', 'text', [
					'label' => 'Description',
					'max_length' => 255
				])
				->add('duree', 'integer')
				->add('seuil', 'integer')
		;
	}
}

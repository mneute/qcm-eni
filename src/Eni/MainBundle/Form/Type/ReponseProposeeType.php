<?php

namespace Eni\MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ReponseProposeeType extends AbstractType {

	public function getName() {
		return 'reponse_proposee';
	}

	public function buildForm(FormBuilderInterface $oBuilder, array $options) {
		$oBuilder
				->add('enonce', 'text', ['label' => 'Enonce', 'max_length' => 255])
				->add('valide', 'checkbox', ['label' => 'Valide']);
	}
}

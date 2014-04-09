<?php

namespace Eni\MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ReponseProposeeType extends AbstractType {

	public function getName() {
		return 'reponse_proposee';
	}

	public function buildForm(FormBuilderInterface $oBuilder, array $options) {
		$oBuilder
				->add('enonce', 'text', [
					'label' => 'Proposition',
					'max_length' => 255
				])
				->add('valide', 'checkbox', [
					'label' => 'Valide',
					'required' => false
				])
		;
	}

	public function setDefaultOptions(OptionsResolverInterface $oResolver) {
		$oResolver->setDefaults([
			'data_class' => 'Eni\MainBundle\Entity\ReponseProposee'
		]);
	}
}

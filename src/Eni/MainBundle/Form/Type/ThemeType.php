<?php

namespace Eni\MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ThemeType extends AbstractType {

	public function getName() {
		return 'theme';
	}

	public function buildForm(FormBuilderInterface $oBuilder, array $tOptions) {
		$oBuilder->add('libelle', 'text', ['label' => 'Libellé', 'max_length' => 255]);
	}
}

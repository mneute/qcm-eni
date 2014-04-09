<?php

namespace Eni\MainBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Eni\MainBundle\Entity\Question;
use Eni\MainBundle\Entity\ReponseProposee;

class LoadReponseProposeeData extends AbstractFixture implements OrderedFixtureInterface {

	public function getOrder() {
		return 6;
	}

	public function load(ObjectManager $oManager) {
		//
		//Question1
		//
		$oQuestion1 = $this->getReference('question1');
		/* @var $oQuestion1 Question */

		$tReponsesProposees = [
			['enonce' => 'Dim', 'valide' => true],
			['enonce' => 'Public', 'valide' => false],
			['enonce' => 'Aucun mot-clé', 'valide' => false],
		];

		foreach ($tReponsesProposees as $tReponseProposee) {
			$oReponseProposee = new ReponseProposee();
			$oReponseProposee
					->setQuestion($oQuestion1)
					->setEnonce($tReponseProposee['enonce'])
					->setValide($tReponseProposee['valide']);
			$oQuestion1->addReponsesProposee($oReponseProposee);
			$oManager->persist($oReponseProposee);
		}

		//
		//Question2
		//
		$oQuestion2 = $this->getReference('question2');
		/* @var $oQuestion2 Question */

		$tReponsesProposees2 = [
			['enonce' => 'VS refusera de compiler la dernière ligne de code', 'valide' => false],
			['enonce' => ' La valeur de Res restera à True', 'valide' => false],
			['enonce' => 'La valeur de Res sera False', 'valide' => true],
			['enonce' => 'Res = 4', 'valide' => false],
		];

		foreach ($tReponsesProposees2 as $tReponseProposee) {
			$oReponseProposee = new ReponseProposee();
			$oReponseProposee
					->setQuestion($oQuestion2)
					->setEnonce($tReponseProposee['enonce'])
					->setValide($tReponseProposee['valide']);
			$oQuestion2->addReponsesProposee($oReponseProposee);
			$oManager->persist($oReponseProposee);
		}


		//
		//Question3
		//
		$oQuestion3 = $this->getReference('question3');
		/* @var $oQuestion3 Question */

		$tReponsesProposees3 = [
			['enonce' => 'Un', 'valide' => false],
			['enonce' => 'Deux', 'valide' => true],
			['enonce' => 'Trois', 'valide' => false],
		];

		foreach ($tReponsesProposees3 as $tReponseProposee) {
			$oReponseProposee = new ReponseProposee();
			$oReponseProposee
					->setQuestion($oQuestion3)
					->setEnonce($tReponseProposee['enonce'])
					->setValide($tReponseProposee['valide']);
			$oQuestion3->addReponsesProposee($oReponseProposee);
			$oManager->persist($oReponseProposee);
		}

		//
		//Question4
		//
		$oQuestion4 = $this->getReference('question4');
		/* @var $oQuestion4 Question */

		$tReponsesProposees4 = [
			['enonce' => 'Vrai', 'valide' => true],
			['enonce' => 'Faux', 'valide' => false],
		];

		foreach ($tReponsesProposees4 as $tReponseProposee) {
			$oReponseProposee = new ReponseProposee();
			$oReponseProposee
					->setQuestion($oQuestion4)
					->setEnonce($tReponseProposee['enonce'])
					->setValide($tReponseProposee['valide']);
			$oQuestion4->addReponsesProposee($oReponseProposee);
			$oManager->persist($oReponseProposee);
		}

		$oManager->flush();
	}
}

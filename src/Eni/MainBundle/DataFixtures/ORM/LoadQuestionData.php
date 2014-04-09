<?php

namespace Eni\MainBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Eni\MainBundle\Entity\Question;

class LoadQuestionData extends AbstractFixture implements OrderedFixtureInterface {

	public function getOrder() {
		return 5;
	}

	public function load(ObjectManager $oManager) {
		$oTheme1 = $this->getReference('theme1');
		$oQuestion = new Question();
		$oQuestion
				->setEnonce("Quel mot-clé est utilisé pour déclarer une variable?")
				->setTheme($oTheme1);
		$oTheme1->addQuestion($oQuestion);
		$oManager->persist($oQuestion);
		$this->addReference('question1', $oQuestion);

		$oTheme2 = $this->getReference('theme2');
		$oQuestion2 = new Question();
		$oQuestion2
				->setEnonce("Quelle est la valeur de Res après l'exécution de la dernière ligne de code ?")
				->setTheme($oTheme2);
		$oTheme2->addQuestion($oQuestion2);
		$oManager->persist($oQuestion2);
		$this->addReference('question2', $oQuestion2);

		$oTheme3 = $this->getReference('theme3');
		$oQuestion3 = new Question();
		$oQuestion3
				->setEnonce("Combien d'étape de compilation dans le framework VB.Net ?")
				->setTheme($oTheme3);
		$oTheme3->addQuestion($oQuestion3);
		$oManager->persist($oQuestion3);
		$this->addReference('question3', $oQuestion3);

		$oTheme4 = $this->getReference('theme4');
		$oQuestion4 = new Question();
		$oQuestion4
				->setEnonce("La plupart de la configuration en VB.Net est faite en XML.")
				->setTheme($oTheme4);
		$oTheme4->addQuestion($oQuestion4);
		$oManager->persist($oQuestion4);
		$this->addReference('question4', $oQuestion4);

		$oManager->flush();
	}
}

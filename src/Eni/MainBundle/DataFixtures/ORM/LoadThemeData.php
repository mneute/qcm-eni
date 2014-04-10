<?php

namespace Eni\MainBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Eni\MainBundle\Entity\Theme;
use Eni\MainBundle\Entity\ThemeTest;

class LoadThemeData extends AbstractFixture implements OrderedFixtureInterface {

	public function getOrder() {
		return 4;
	}

	public function load(ObjectManager $oManager) {
		$oTest = $this->getReference('test-vs');
		$oTest2 = $this->getReference('test-sql');

		/**
		 * Theme 1 Test 1
		 */
		$oTheme = new Theme();
		$oTheme->setLibelle('Les variables en VB.Net');

		$oThemeTest = new ThemeTest();
		$oThemeTest
				->setTest($oTest)
				->setNbQuestionsATirer(1)
				->setTheme($oTheme);

		$oTheme->addThemeTest($oThemeTest);

		$oManager->persist($oThemeTest);
		$oManager->persist($oTheme);

		/**
		 * Theme 2 Test 1
		 */
		$oTheme2 = new Theme();
		$oTheme2->setLibelle('PL/SQL');

		$oThemeTest2 = new ThemeTest();
		$oThemeTest2
				->setTest($oTest)
				->setNbQuestionsATirer(2)
				->setTheme($oTheme2);

		$oTheme2->addThemeTest($oThemeTest2);

		$oManager->persist($oThemeTest2);
		$oManager->persist($oTheme2);

		/**
		 * Theme 3 Test 2
		 */
		$oTheme3 = new Theme();
		$oTheme3->setLibelle('Les fonctions en VB.Net');

		$oThemeTest3 = new ThemeTest();
		$oThemeTest3
				->setTest($oTest2)
				->setNbQuestionsATirer(3)
				->setTheme($oTheme3);

		$oTheme3->addThemeTest($oThemeTest3);

		$oManager->persist($oThemeTest3);
		$oManager->persist($oTheme3);

		/**
		 * Theme 4 Test 2
		 */
		$oTheme4 = new Theme();
		$oTheme4->setLibelle('PHP');

		$oThemeTest4 = new ThemeTest();
		$oThemeTest4
				->setTest($oTest2)
				->setNbQuestionsATirer(4)
				->setTheme($oTheme4);

		$oTheme4->addThemeTest($oThemeTest4);

		$oManager->persist($oThemeTest4);
		$oManager->persist($oTheme4);

		$oManager->flush();

		$this->addReference('themeTest1', $oThemeTest);
		$this->addReference('themeTest2', $oThemeTest2);
		$this->addReference('themeTest3', $oThemeTest3);
		$this->addReference('themeTest4', $oThemeTest4);
		$this->addReference('theme1', $oTheme);
		$this->addReference('theme2', $oTheme2);
		$this->addReference('theme3', $oTheme3);
		$this->addReference('theme4', $oTheme4);
	}
}

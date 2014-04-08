<?php

namespace Eni\MainBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Eni\MainBundle\Entity\Theme;

class LoadThemeData extends AbstractFixture implements OrderedFixtureInterface {

	public function getOrder() {
		return 4;
	}

	public function load(ObjectManager $oManager) {
		$oTheme = new Theme();
		$oTheme->setLibelle('Les variables en VB.Net');
		$oManager->persist($oTheme);

		$oTheme2 = new Theme();
		$oTheme2->setLibelle('PL/SQL');
		$oManager->persist($oTheme2);

		$oTheme3 = new Theme();
		$oTheme3->setLibelle('Les fonctions en VB.Net');
		$oManager->persist($oTheme3);

		$oTheme4 = new Theme();
		$oTheme4->setLibelle('PHP');
		$oManager->persist($oTheme4);

		$oManager->flush();
	}
}

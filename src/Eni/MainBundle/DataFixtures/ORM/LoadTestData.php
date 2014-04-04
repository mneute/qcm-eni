<?php

namespace Eni\MainBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadTestData extends AbstractFixture implements OrderedFixtureInterface {

	public function getOrder() {
		return 2;
	}

	public function load(ObjectManager $oManager) {
		$oTestVS = new \Eni\MainBundle\Entity\Test();
		$oTestVS->setLibelle('Dévellopez avec VS 2010')
				->setDescription('Apprenez à développer avec Visual Studio 2010')
				->setDuree(60)
				->setSeuil(70);
		$oManager->persist($oTestVS);
		$this->addReference('test-vs', $oTestVS);

		$oTestSQL = new \Eni\MainBundle\Entity\Test();
		$oTestSQL->setLibelle('Manipuler les données avec SQL')
				->setDescription('Apprennez à faire des requêtes SQL')
				->setDuree(60)
				->setSeuil(60);
		$oManager->persist($oTestSQL);
		$this->addReference('test-sql', $oTestSQL);
		$oManager->flush();
	}
}

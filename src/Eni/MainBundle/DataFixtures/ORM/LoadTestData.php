<?php

namespace Eni\MainBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Eni\MainBundle\Entity\Test;
use Eni\MainBundle\Entity\Utilisateur;

class LoadTestData extends AbstractFixture implements OrderedFixtureInterface {

	public function getOrder() {
		return 3;
	}

	public function load(ObjectManager $oManager) {
		$oFormateur = $this->getReference('utilisateur-formateur');
		/* @var $oFormateur Utilisateur */
		$oTestVS = new Test();
		$oTestVS->setLibelle('Dévellopez avec VS 2010')
				->setDescription('Apprenez à développer avec Visual Studio 2010')
				->setDuree(60)
				->setSeuil(70)
				->setUtilisateur($oFormateur);
		$oFormateur->addTest($oTestVS);
		$oManager->persist($oTestVS);
		$this->addReference('test-vs', $oTestVS);

		$oTestSQL = new Test();
		$oTestSQL->setLibelle('Manipuler les données avec SQL')
				->setDescription('Apprennez à faire des requêtes SQL')
				->setDuree(60)
				->setSeuil(60)
				->setUtilisateur($oFormateur);
		$oFormateur->addTest($oTestSQL);
		$oManager->persist($oTestSQL);
		$this->addReference('test-sql', $oTestSQL);
		$oManager->flush();
	}
}

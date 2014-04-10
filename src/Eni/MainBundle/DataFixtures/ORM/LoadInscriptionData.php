<?php

namespace Eni\MainBundle\DataFixtures\ORM;

use DateTime;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Eni\MainBundle\Entity\Inscription;
use Eni\MainBundle\Entity\Test;
use Eni\MainBundle\Entity\Utilisateur;

class LoadInscriptionData extends AbstractFixture implements OrderedFixtureInterface {

	public function getOrder() {
		return 7;
	}

	public function load(ObjectManager $oManager) {
		/**
		 * Inscription 0 : Utilisateur 0 inscrit au test vs
		 */
		$oUtilisateur = $this->getReference('utilisateur-0');
		/* @var $oUtilisateur Utilisateur */
		$oTest = $this->getReference('test-vs');
		/* @var $oTest Test */
		$format = "d/M/Y h:i:s";
		$oInscription = new Inscription();
		$oInscription
				->setUtilisateur($oUtilisateur)
				->setEtat(true)
				->setTest($oTest)
				->setDureeValidite(DateTime::createFromFormat($format, date($format, time() + (60 * 60 * 24 * 30))))
		;
		$oUtilisateur->addInscription($oInscription);
		$oTest->addInscription($oInscription);
		$oManager->persist($oInscription);
		$this->addReference('utilisateur 0 inscription-vs', $oInscription);

		/**
		 * Inscription 1 : Utilisateur 1 inscrit au test sql
		 */
		$oUtilisateur1 = $this->getReference('utilisateur-1');
		/* @var $oUtilisateur Utilisateur */
		$oTest1 = $this->getReference('test-sql');
		/* @var $oTest Test */
		$oInscription1 = new Inscription();
		$oInscription1
				->setUtilisateur($oUtilisateur1)
				->setEtat(true)
				->setTest($oTest1)
				->setDureeValidite(DateTime::createFromFormat($format, date($format, time() + (60 * 60 * 24 * 30))))
		;
		$oUtilisateur1->addInscription($oInscription1);
		$oTest1->addInscription($oInscription1);
		$oManager->persist($oInscription1);
		$this->addReference('utilisateur 1 inscription-sql', $oInscription1);

		/**
		 * Inscription 2 : Utilisateur 0 inscrit au test sql
		 */
		$oInscription2 = new Inscription();
		$oInscription2
				->setUtilisateur($oUtilisateur)
				->setEtat(true)
				->setTest($oTest1)
				->setDureeValidite(DateTime::createFromFormat($format, date($format, time() + (60 * 60 * 24 * 30))))
		;
		$oUtilisateur->addInscription($oInscription2);
		$oTest1->addInscription($oInscription2);
		$oManager->persist($oInscription2);
		$this->addReference('utilisateur 0 inscription-sql', $oInscription2);

		$oManager->flush();
	}
}

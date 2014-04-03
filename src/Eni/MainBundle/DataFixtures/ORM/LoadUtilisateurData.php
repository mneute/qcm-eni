<?php

namespace Eni\MainBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Eni\MainBundle\Entity\Promotion;
use Eni\MainBundle\Entity\Utilisateur;
use FOS\UserBundle\Doctrine\UserManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUtilisateurData implements FixtureInterface, ContainerAwareInterface {

	/**
	 * @var ContainerInterface
	 */
	private $oContainer;

	public function setContainer(ContainerInterface $container = null) {
		$this->oContainer = $container;
	}

	public function load(ObjectManager $oManager) {
		$oUserManager = $this->oContainer->get('fos_user.user_manager');
		/* @var $oUserManager UserManager */

		/**
		 * ADMIN
		 */
		$oUtilisateur = $oUserManager->createUser();
		/* @var $oUtilisateur Utilisateur */
		$oUtilisateur->setUsername('admin')
				->setEmail('admin@mail.fr')
				->setPlainPassword('admin')
				->setNom('admin')
				->setPrenom('admin')
				->addRole('ROLE_ADMIN');
		$oUserManager->updateUser($oUtilisateur);

		/**
		 * FORMATEUR
		 */
		$oUtilisateur = $oUserManager->createUser();
		/* @var $oUtilisateur Utilisateur */
		$oUtilisateur->setUsername('trichard')
				->setEmail('trichard@email.fr')
				->setPlainPassword('trichard')
				->setNom('richard')
				->setPrenom('thierry')
				->addRole('ROLE_FORMATEUR');
		$oUserManager->updateUser($oUtilisateur);

		/**
		 * STAGIAIRE
		 */
		$oUtilisateur = $oUserManager->createUser();
		/* @var $oUtilisateur Utilisateur */
		$oUtilisateur->setUsername('jdupond')
				->setEmail('jdupond@email.fr')
				->setPlainPassword('jdupond')
				->setNom('dupond')
				->setPrenom('Jean');
		$oUserManager->updateUser($oUtilisateur);

		$oPromotion = new Promotion();
		$oPromotion->setLibelle('CDI8');

		/**
		 * STAGIAIRE AVEC FORMATION
		 */
		$oUtilisateur = $oUserManager->createUser();
		/* @var $oUtilisateur Utilisateur */
		$oUtilisateur->setUsername('toto')
				->setEmail('toto@email.fr')
				->setPlainPassword('toto')
				->setNom('to')
				->setPrenom('to');
		$oUtilisateur->setPromotion($oPromotion);
		$oPromotion->addUtilisateur($oUtilisateur);

		$oManager->persist($oPromotion);
		$oUserManager->updateUser($oUtilisateur);
	}
}

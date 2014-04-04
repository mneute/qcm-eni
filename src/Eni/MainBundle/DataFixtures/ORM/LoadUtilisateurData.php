<?php

namespace Eni\MainBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Eni\MainBundle\Entity\Promotion;
use Eni\MainBundle\Entity\Utilisateur;
use FOS\UserBundle\Doctrine\UserManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUtilisateurData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface {

	/**
	 * @var ContainerInterface
	 */
	private $oContainer;

	public function setContainer(ContainerInterface $container = null) {
		$this->oContainer = $container;
	}

	public function getOrder() {
		return 2;
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
				->setPrenom('Admin')
				->addRole('ROLE_ADMIN')
				->setEnabled(true);
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
				->setPrenom('Thierry')
				->addRole('ROLE_FORMATEUR')
				->setEnabled(true);
		$oUserManager->updateUser($oUtilisateur);
		$this->addReference('utilisateur-formateur', $oUtilisateur);

		/**
		 * STAGIAIRE
		 */
		$oUtilisateur = $oUserManager->createUser();
		/* @var $oUtilisateur Utilisateur */
		$oUtilisateur->setUsername('jdupond')
				->setEmail('jdupond@email.fr')
				->setPlainPassword('jdupond')
				->setNom('dupond')
				->setPrenom('Jean')
				->addRole('ROLE_STAGIAIRE')
				->setEnabled(true);
		$oUserManager->updateUser($oUtilisateur);

		/**
		 * STAGIAIRE AVEC PROMOTION
		 */
		$tUtilisateurs = [
			['username' => 'mneute', 'nom' => 'neute', 'prenom' => 'Morgan'],
			['username' => 'ebertho', 'nom' => 'bertho', 'prenom' => 'Etienne'],
			['username' => 'jmabilais', 'nom' => 'mabilais', 'prenom' => 'Jonathan'],
			['username' => 'pvakala', 'nom' => 'vakala', 'prenom' => 'Pierre'],
		];

		$oPromotion = $this->getReference('promotion-CDI8');
		/* @var $oPromotion Promotion */

		foreach ($tUtilisateurs as $tUtilisateur) {
			$oUtilisateur = $oUserManager->createUser();
			/* @var $tUtilisateur Utilisateur */
			$oUtilisateur->setUsername($tUtilisateur['username'])
					->setEmail($tUtilisateur['username'] . '@email.fr')
					->setPlainPassword($tUtilisateur['username'])
					->setNom($tUtilisateur['nom'])
					->setPrenom($tUtilisateur['prenom'])
					->addRole('ROLE_STAGIAIRE')
					->setEnabled(true);
			$oUtilisateur->setPromotion($oPromotion);
			$oPromotion->addUtilisateur($oUtilisateur);

			$oUserManager->updateUser($oUtilisateur);
		}
	}
}

<?php

namespace Eni\MainBundle\Controller;

use Eni\MainBundle\Entity\Utilisateur;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AccueilController extends Controller {

	/**
	 * @var Utilisateur
	 */
	private $oUtilisateurConnecte;

	public function preExecute() {
		$this->oUtilisateurConnecte = $this->get('security.context')->getToken()->getUser();
	}

	/**
	 * @Route("/formateur", name="accueil-formateur")
	 * @Template
	 */
	public function accueilFormateurAction() {
		if ($this->oUtilisateurConnecte->estStagiaire()) {
			return $this->redirect($this->generateUrl('accueil-stagiaire'));
		} else {
			return [];
		}
	}

	/**
	 * @Route("/")
	 * @Route("/stagiaire", name="accueil-stagiaire")
	 * @Template
	 */
	public function accueilStagiaireAction() {
		$toTests = [];
		if ($this->oUtilisateurConnecte->estFormateur() || $this->oUtilisateurConnecte->estAdministrateur()) {
			$oTestRepository = $this->getDoctrine()->getManager()->getRepository('MainBundle:Test');
			/* @var $oTestRepository \Eni\MainBundle\Entity\TestRepository */
			$toTests = $oTestRepository->findAll();
		} else if ($this->oUtilisateurConnecte->estStagiaire()) {
			$toInscriptions = $this->oUtilisateurConnecte->getInscriptions();
			foreach ($toInscriptions as $oInscription) {
				/* @var $oInscription \Eni\MainBundle\Entity\Inscription */
				$toTests[] = $oInscription->getTest();
			}
		} else {
			throw new \Exception('Problème dans la BDD, l\'utilisateur n\'a aucun rôle');
		}
		return ['toTests' => $toTests];
	}
}

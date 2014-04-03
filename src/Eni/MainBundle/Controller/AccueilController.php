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
	 */
	public function accueilStagiaireAction() {
		return [];
	}
}

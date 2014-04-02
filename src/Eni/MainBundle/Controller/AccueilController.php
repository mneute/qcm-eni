<?php

namespace Eni\MainBundle\Controller;

use Eni\MainBundle\Entity\Utilisateur;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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
	 */
	public function accueilFormateurAction() {

	}

	/**
	 * @Route("/stagiaire", name="accueil-stagiaire")
	 */
	public function accueilStagiaireAction() {

	}
}

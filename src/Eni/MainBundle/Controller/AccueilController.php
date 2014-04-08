<?php

namespace Eni\MainBundle\Controller;

use Eni\MainBundle\Entity\Inscription;
use Eni\MainBundle\Entity\Test;
use Eni\MainBundle\Entity\TestRepository;
use Eni\MainBundle\Entity\Utilisateur;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

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
			/* @var $oTestRepository TestRepository */
			$toTests = $oTestRepository->findAll();
		} else if ($this->oUtilisateurConnecte->estStagiaire()) {
			$toInscriptions = $this->oUtilisateurConnecte->getInscriptions();
			foreach ($toInscriptions as $oInscription) {
				/* @var $oInscription Inscription */
				$toTests[] = $oInscription->getTest();
			}
		} else {
			throw new \Exception('Problème dans la BDD, l\'utilisateur n\'a aucun rôle');
		}
		return ['toTests' => $toTests];
		//return new \Symfony\Component\HttpFoundation\Response($this->renderView('MainBundle:Accueil:accueilStagiaire.html.twig', ['toTests' => $toTests]));
	}

	/**
	 * @Route("/confirmationLancementTest/{id}", name="confirmationLancementTest")
	 * @Method({"POST"})
	 */
	public function confirmationLancementTestAction(Test $oTest, Request $oRequest) {
		if ($oRequest->isXmlHttpRequest()) {
			$html = $this->renderView('MainBundle:Modal:confirmationLancementTest.html.twig', ['oTest' => $oTest]);
			return new JsonResponse(['html' => $html, 'success' => true]);
		} else {
			return $this->redirect($this->generateUrl("accueil-stagiaire"));
		}
	}
}

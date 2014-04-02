<?php

namespace Eni\MainBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\SecurityContext;

class SecurityController extends Controller {

	/**
	 * @Route("/connexion", name="connexion", options={"expose"=true})
	 * @Template
	 */
	public function connexionAction(Request $oRequest) {
		$oSession = $oRequest->getSession();
		/* @var $oSession Session */

		// get the error if any (works with forward and redirect -- see below)
		if ($oRequest->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
			$error = $oRequest->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
		} elseif (null !== $oSession && $oSession->has(SecurityContext::AUTHENTICATION_ERROR)) {
			$error = $oSession->get(SecurityContext::AUTHENTICATION_ERROR);
			$oSession->remove(SecurityContext::AUTHENTICATION_ERROR);
		} else {
			$error = '';
		}

		if ($error) {
			$error = $error->getMessage();
		}
		// last username entered by the user
		$lastUsername = (is_null($oSession)) ? '' : $oSession->get(SecurityContext::LAST_USERNAME);

		$csrfToken = $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate');

		return ['last_username' => $lastUsername, 'csrf_token' => $csrfToken, 'error' => $error];
	}

	/**
	 * @Route("/deconnexion", name="deconnexion")
	 */
	public function deconnexionAction() {
		throw new \Exception('Vérifier votre security.yml : mal configuré');
	}

	/**
	 * @Route("/verifie_login", name="verifie_login")
	 */
	public function verifieLoginAction() {
		throw new \Exception('Vérifier votre security.yml : mal configuré');
	}
}

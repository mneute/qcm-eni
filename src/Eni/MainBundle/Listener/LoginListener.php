<?php

namespace Eni\MainBundle\Listener;

use Eni\MainBundle\Entity\Utilisateur;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class LoginListener {

	/**
	 * @var SecurityContext
	 */
	private $oSecurityContext;

	/**
	 * @var Router
	 */
	private $oRouter;

	/**
	 * @var EventDispatcherInterface
	 */
	private $oEventDispatcher;

	public function __construct(SecurityContext $oSecurityContext, Router $oRouter, EventDispatcherInterface $oEventDispatcher) {
		$this->oSecurityContext = $oSecurityContext;
		$this->oRouter = $oRouter;
		$this->oEventDispatcher = $oEventDispatcher;
	}

	public function onSecurityInteractiveLogin(InteractiveLoginEvent $oEvent) {
		// on écoute l'évènement kernel.response
		$this->oEventDispatcher->addListener(KernelEvents::RESPONSE, [$this, 'redirigeUtilisateurVersPageAccueil']);
	}

	public function redirigeUtilisateurVersPageAccueil(FilterResponseEvent $oResponseEvent) {
		$oUtilisateurConnecte = $this->oSecurityContext->getToken()->getUser();
		/* @var $oUtilisateurConnecte Utilisateur */

		if ($oUtilisateurConnecte->estFormateur() || $oUtilisateurConnecte->estAdministrateur()) {
			$oResponse = new RedirectResponse($this->oRouter->generate('accueil-formateur'));
		} else {
			$oResponse = new RedirectResponse($this->oRouter->generate('accueil-stagiaire'));
		}
		$oResponseEvent->setResponse($oResponse);
	}
}

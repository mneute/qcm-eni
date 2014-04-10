<?php

namespace Eni\MainBundle\Controller;

use Doctrine\ORM\EntityManager;
use Eni\MainBundle\Entity\Theme;
use Eni\MainBundle\Entity\ThemeRepository;
use Eni\MainBundle\Form\Type\ThemeType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * @Route("/administration/themes")
 */
class AdministrationThemeController extends Controller {

	/**
	 * @var EntityManager
	 */
	private $oManager;

	public function preExecute() {
		$this->oManager = $this->getDoctrine()->getManager();
	}

	/**
	 * @Route("/", name="themes")
	 * @Template
	 */
	public function listeThemeAction() {
		$oThemeRepository = $this->getDoctrine()->getManager()->getRepository('MainBundle:Theme');
		/* @var $oThemeRepository ThemeRepository */
		$toTheme = $oThemeRepository->findAll();
		return ['toTheme' => $toTheme];
	}

	/**
	 * @Route("/{id}", name="modifAjoutTheme", requirements={"id" = "-?\d+"})
	 * @Template
	 */
	public function modifAjoutThemeAction($id, Request $oRequest) {
		$oTheme = null;
		$titre = '';
		if ($id == -1) {
			//ajout
			$oTheme = new Theme();
			$titre = "Ajouter un thème";
		} else {
			//modif
			$oTheme = $this->oManager->getRepository('MainBundle:Theme')->findOneBy(['id' => $id]);
			/* @var $oTheme Theme */
			if (is_null($oTheme)) {
				throw new HttpException(404, sprintf('Le thème %d n\'existe pas', $id));
			}
			$titre = "Modifier un thème";
		}
		$oForm = $this->createForm(new ThemeType(), $oTheme);

		if ($oRequest->isMethod('POST')) {
			//Validation du formulaire
			$oForm->submit($oRequest);
			if ($oForm->isValid()) {
				$this->oManager->persist($oTheme);
				$this->oManager->flush();
				return $this->redirect($this->generateUrl("themes"));
			}
		}

		// on arrive ici dans 2 cas : la requete est de type GET ou le formulaire contient des erreurs
		return ['oForm' => $oForm->createView(), 'titre' => $titre];
	}

	/**
	 * @Route("/{id}/confirmation-suppression", name="confirmationSuppressionTheme", requirements={"id" = "\d+"})
	 * @Method({"POST"})
	 */
	public function confirmationSuppressionThemeAction(Request $oRequest, Theme $oTheme) {
		if ($oRequest->isXmlHttpRequest()) {
			$tRetour = [
				'success' => true,
				'html' => $this->renderView('MainBundle:Modal:confirmationSuppressionTheme.html.twig', ['oTheme' => $oTheme])
			];

			return new JsonResponse($tRetour);
		} else {
			return $this->redirect($this->generateUrl('themes'));
		}
	}

	/**
	 * @Route("/{id}/suppression", name="validationSuppressionTheme", requirements={"id" = "\d+"}, options={"expose"=true})
	 * @Method({"POST"})
	 */
	public function validationSuppressionThemeAction(Request $oRequest, Theme $oTheme) {
		if ($oRequest->isXmlHttpRequest()) {
			$this->oManager->remove($oTheme);
			$this->oManager->flush();
			return new JsonResponse([
				'success' => true,
				'location' => $this->generateUrl('themes')
			]);
		} else {
			return $this->redirect($this->generateUrl('themes'));
		}
	}
}

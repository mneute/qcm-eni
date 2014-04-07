<?php

namespace Eni\MainBundle\Controller;

use Doctrine\ORM\EntityManager;
use Eni\MainBundle\Entity\Theme;
use Eni\MainBundle\Entity\ThemeRepository;
use Eni\MainBundle\Form\Type\ThemeType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AdministrationController extends Controller {

	/**
	 * @var EntityManager
	 */
	private $oManager;

	public function preExecute() {
		$this->oManager = $this->getDoctrine()->getManager();
	}

	/**
	 * @Route("/themes", name="themes")
	 * @Template("MainBundle:Administration:listeTheme.html.twig")
	 */
	public function listeThemeAction() {
		$oThemeRepository = $this->getDoctrine()->getManager()->getRepository('MainBundle:Theme');
		/* @var $oThemeRepository ThemeRepository */
		$toTheme = $oThemeRepository->findAll();
		return ['toTheme' => $toTheme];
	}

	/**
	 * @Route("/themes/{id}", name="modifAjoutTheme", requirements={"id" = "-?\d+"})
	 * @Template
	 */
	public function modifAjoutThemeAction($id, Request $oRequest) {
		$oTheme = null;
		if ($id == -1) {
			//ajout
			$oTheme = new Theme();
		} else {
			//modif
			$oTheme = $this->oManager->getRepository('MainBundle:Theme')->findOneBy(['id' => $id]);
			/* @var $oTheme Theme */
			if (is_null($oTheme)) {
				throw new HttpException(404, sprintf('le thème %d n\'existe pas', $id));
			}
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

		return ['oForm' => $oForm->createView()];
	}
}

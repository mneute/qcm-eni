<?php

namespace Eni\MainBundle\Controller;

use Doctrine\ORM\EntityManager;
use Eni\MainBundle\Entity\Test;
use Eni\MainBundle\Entity\TestRepository;
use Eni\MainBundle\Entity\Utilisateur;
use Eni\MainBundle\Form\Type\TestType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * @Route("/tests")
 */
class AdministrationTestController extends Controller {

	/**
	 * @var EntityManager
	 */
	private $oManager;

	/**
	 * @var Utilisateur
	 */
	private $oUtilisateur;

	public function preExecute() {
		$this->oManager = $this->getDoctrine()->getManager();
		$this->oUtilisateur = $this->container->get('security.context')->getToken()->getUser();
	}

	/**
	 * @Route("/", name="tests")
	 * @Template
	 */
	public function listeTestAction() {
		$oTestRepository = $this->getDoctrine()->getManager()->getRepository('MainBundle:Test');
		/* @var $oTestRepository TestRepository */
		$toTest = $oTestRepository->findAll();
		return ['toTest' => $toTest];
	}

	/**
	 * @Route("/{id}", name="modifAjoutTest", requirements={"id" = "-?\d+"})
	 * @Template
	 */
	public function modifAjoutTestAction($id, Request $oRequest) {
		$oTest = null;
		$titre = '';
		if ($id == -1) {
			//ajout
			$oTest = new Test();
			$oTest->setUtilisateur($this->oUtilisateur);
			$this->oUtilisateur->addTest($oTest);
			$titre = "Ajouter un test";
		} else {
			//modif
			$oTest = $this->oManager->getRepository('MainBundle:Test')->findOneBy(['id' => $id]);
			/* @var $oTest Test */
			if (is_null($oTest)) {
				throw new HttpException(404, sprintf('Le test %d n\'existe pas', $id));
			}
			$titre = "Modifier un test";
		}
		$oForm = $this->createForm(new TestType(), $oTest);

		if ($oRequest->isMethod('POST')) {
			//Validation du formulaire
			$oForm->submit($oRequest);
			if ($oForm->isValid()) {
				$this->oManager->persist($oTest);
				$this->oManager->flush();
				return $this->redirect($this->generateUrl("tests"));
			}
		}

		// on arrive ici dans 2 cas : la requete est de type GET ou le formulaire contient des erreurs
		return ['oForm' => $oForm->createView(), 'titre' => $titre];
	}

	/**
	 * @Route("/{id}/confirmation-suppression", name="confirmationSuppressionTest", requirements={"id" = "\d+"})
	 * @Method({"POST"})
	 */
	public function confirmationSuppressionTestAction(Request $oRequest, Test $oTest) {
		if ($oRequest->isXmlHttpRequest()) {
			$tRetour = [
				'success' => true,
				'html' => $this->renderView('MainBundle:Modal:confirmationSuppressionTest.html.twig', ['oTest' => $oTest])
			];

			return new JsonResponse($tRetour);
		} else {
			return $this->redirect($this->generateUrl('tests'));
		}
	}

	/**
	 * @Route("/{id}/suppression", name="validationSuppressionTest", requirements={"id" = "\d+"}, options={"expose"=true})
	 * @Method({"POST"})
	 */
	public function validationSuppressionTestAction(Request $oRequest, Test $oTest) {
		if ($oRequest->isXmlHttpRequest()) {
			$this->oManager->remove($oTest);
			$this->oManager->flush();
			return new JsonResponse([
				'success' => true,
				'location' => $this->generateUrl('tests')
			]);
		} else {
			return $this->redirect($this->generateUrl('tests'));
		}
	}
}

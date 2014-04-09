<?php

namespace Eni\MainBundle\Controller;

use Doctrine\ORM\EntityManager;
use Eni\MainBundle\Entity\Question;
use Eni\MainBundle\Entity\QuestionRepository;
use Eni\MainBundle\Form\Type\QuestionType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * @Route("/questions")
 */
class AdministrationQuestionController extends Controller {

	/**
	 * @var EntityManager
	 */
	private $oManager;

	public function preExecute() {
		$this->oManager = $this->getDoctrine()->getManager();
	}

	/**
	 * @Route("/", name="questions")
	 * @Template
	 */
	public function listeQuestionAction() {
		$oQuestionResository = $this->getDoctrine()->getManager()->getRepository('MainBundle:Question');
		/* @var $oQuestionResository QuestionRepository */
		$toQuestions = $oQuestionResository->findAll();

		return ['toQuestions' => $toQuestions];
	}

	/**
	 * @Route("/{id}", name="modifAjoutQuestion", requirements={"id" = "-?\d+"})
	 * @Template
	 */
	public function modifAjoutQuestionAction($id, Request $oRequest) {
		$oQuestion = null;
		$titre = '';
		$toReponsesDepart = [];

		if ($id == -1) {
			// création
			$oQuestion = new Question();
			$titre = 'Ajouter une question';
		} else {
			// modification
			$oQuestion = $this->oManager->getRepository('MainBundle:Question')->find($id);
			/* @var $oQuestion Question */
			if (is_null($oQuestion)) {
				throw new HttpException(404, sprintf('La question %d n\'existe pas', $id));
			}

			$titre = 'Modifier une question';

			$toReponsesDepart = clone $oQuestion->getReponsesProposees();
		}

		$oForm = $this->createForm(new QuestionType(), $oQuestion);

		if ($oRequest->isMethod('POST')) {
			$oForm->submit($oRequest);
			if ($oForm->isValid()) {
				foreach ($toReponsesDepart as $oReponseDepart) {
					if (!$oQuestion->getReponsesProposees()->contains($oReponseDepart)) {
						$oQuestion->removeReponsesProposee($oReponseDepart);
						$this->oManager->remove($oReponseDepart);
					}
				}

				$this->oManager->persist($oQuestion);
				$this->oManager->flush();

				return $this->redirect($this->generateUrl('questions'));
			}
		}

		return ['oForm' => $oForm->createView(), 'titre' => $titre];
	}

	/**
	 * @Route("/{id}/confirmation-suppression", name="confirmationSuppressionQuestion", requirements={"id" = "\d+"})
	 */
	public function confirmationSuppressionQuestionAction(Request $oRequest, Question $oQuestion) {
		if ($oRequest->isXmlHttpRequest()) {
			$tRetour = [
				'success' => true,
				'html' => $this->renderView('MainBundle:Modal:confirmationSuppressionQuestion.html.twig', ['oQuestion' => $oQuestion])
			];

			return new JsonResponse($tRetour);
		} else {
			return $this->redirect($this->generateUrl('themes'));
		}
	}

	/**
	 * @Route("/{id}/suppression", name="validationSuppressionQuestion", requirements={"id" = "\d+"}, options={"expose"=true})
	 * @Method({"POST"})
	 */
	public function validationSuppressionThemeAction(Request $oRequest, Question $oQuestion) {
		if ($oRequest->isXmlHttpRequest()) {
			$this->oManager->remove($oQuestion);
			$this->oManager->flush();
			return new JsonResponse([
				'success' => true,
				'location' => $this->generateUrl('questions')
			]);
		} else {
			return $this->redirect($this->generateUrl('questions'));
		}
	}
}

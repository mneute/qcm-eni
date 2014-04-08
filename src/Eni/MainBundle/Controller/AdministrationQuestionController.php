<?php

namespace Eni\MainBundle\Controller;

use Eni\MainBundle\Entity\QuestionRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/questions")
 */
class AdministrationQuestionController extends Controller {

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
	 */
	public function modifAjoutQuestionAction($id, Request $oRequest) {
		
	}
}

<?php

namespace Eni\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * reponseDonnee
 *
 * @ORM\Table(name="reponse_donnee")
 * @ORM\Entity(repositoryClass="Eni\MainBundle\Entity\reponseDonneeRepository")
 */
class ReponseDonnee {

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @ORM\ManyToOne(targetEntity="QuestionTirage", cascade={"all"}, inversedBy="reponsesDonnees")
	 * @ORM\JoinColumn(name="question_tirage_id", referencedColumnName="id", nullable=false)
	 */
	private $questionTirage;

	/**
	 * @ORM\ManyToOne(targetEntity="ReponseProposee", cascade={"all"}, inversedBy="reponsesDonnees")
	 * @ORM\JoinColumn(name="reponse_proposee_id", referencedColumnName="id", nullable=false)
	 */
	private $reponseProposee;

	/**
	 * Get id
	 *
	 * @return integer
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Set questionTirage
	 *
	 * @param \Eni\MainBundle\Entity\QuestionDonnee $questionTirage
	 * @return reponseDonnee
	 */
	public function setQuestionTirage(QuestionTirage $questionTirage) {
		$this->questionTirage = $questionTirage;

		return $this;
	}

	/**
	 * Get questionTirage
	 *
	 * @return QuestionTirage
	 */
	public function getQuestionTirage() {
		return $this->questionTirage;
	}

	/**
	 * Set reponseProposee
	 *
	 * @param ReponseProposee $reponseProposee
	 * @return ReponseDonnee
	 */
	public function setReponseProposee(ReponseProposee $reponseProposee) {
		$this->reponseProposee = $reponseProposee;

		return $this;
	}

	/**
	 * Get reponseProposee
	 *
	 * @return ReponseProposee
	 */
	public function getReponseProposee() {
		return $this->reponseProposee;
	}
}

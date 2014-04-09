<?php

namespace Eni\MainBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Question
 *
 * @ORM\Table(name="question")
 * @ORM\Entity(repositoryClass="QuestionRepository")
 */
class Question {

	/**
	 * @var integer
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @var string
	 * @ORM\Column(name="enonce", type="string", length=255)
	 */
	private $enonce;

	/**
	 * @var string
	 * @ORM\Column(name="media", type="string", length=255, nullable=true)
	 */
	private $media;

	/**
	 * @ORM\OneToMany(targetEntity="ReponseProposee", mappedBy="question", cascade={"persist", "remove"})
	 */
	private $reponsesProposees;

	/**
	 * @ORM\OneToMany(targetEntity="QuestionTirage", mappedBy="question", cascade={"persist", "remove"})
	 */
	private $questionTirages;

	/**
	 * @ORM\ManyToOne(targetEntity="Theme", cascade={"persist"}, inversedBy="questions")
	 * @ORM\JoinColumn(name="theme_id", referencedColumnName="id")
	 */
	private $theme;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->reponsesProposees = new ArrayCollection();
		$this->questionTirages = new ArrayCollection();
	}

	/**
	 * Get id
	 * @return integer
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Set enonce
	 * @param string $enonce
	 * @return Question
	 */
	public function setEnonce($enonce) {
		$this->enonce = $enonce;
		return $this;
	}

	/**
	 * Get enonce
	 * @return string
	 */
	public function getEnonce() {
		return $this->enonce;
	}

	/**
	 * Set media
	 * @param string $media
	 * @return Question
	 */
	public function setMedia($media) {
		$this->media = $media;
		return $this;
	}

	/**
	 * Get media
	 * @return string
	 */
	public function getMedia() {
		return $this->media;
	}

	/**
	 * Add reponsesProposees
	 *
	 * @param ReponseProposee $reponsesProposees
	 * @return Question
	 */
	public function addReponsesProposee(ReponseProposee $reponsesProposees) {
		$this->reponsesProposees[] = $reponsesProposees;
		$reponsesProposees->setQuestion($this);

		return $this;
	}

	/**
	 * Remove reponsesProposees
	 *
	 * @param ReponseProposee $reponsesProposees
	 */
	public function removeReponsesProposee(ReponseProposee $reponsesProposees) {
		$this->reponsesProposees->removeElement($reponsesProposees);
	}

	/**
	 * Get reponsesProposees
	 *
	 * @return ArrayCollection
	 */
	public function getReponsesProposees() {
		return $this->reponsesProposees;
	}

	/**
	 * Add questionTirages
	 *
	 * @param QuestionTirage $questionTirages
	 * @return Question
	 */
	public function addQuestionTirage(QuestionTirage $questionTirages) {
		$this->questionTirages[] = $questionTirages;

		return $this;
	}

	/**
	 * Remove questionTirages
	 *
	 * @param QuestionTirage $questionTirages
	 */
	public function removeQuestionTirage(QuestionTirage $questionTirages) {
		$this->questionTirages->removeElement($questionTirages);
	}

	/**
	 * Get questionTirages
	 *
	 * @return ArrayCollection
	 */
	public function getQuestionTirages() {
		return $this->questionTirages;
	}

	/**
	 * Set theme
	 *
	 * @param Theme $theme
	 * @return Question
	 */
	public function setTheme(Theme $theme = null) {
		$this->theme = $theme;

		return $this;
	}

	/**
	 * Get theme
	 *
	 * @return Theme
	 */
	public function getTheme() {
		return $this->theme;
	}
}

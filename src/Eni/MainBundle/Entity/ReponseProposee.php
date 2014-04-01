<?php

namespace Eni\MainBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * ReponseProposee
 *
 * @ORM\Table(name="reponse_proposee")
 * @ORM\Entity(repositoryClass="ReponseProposeeRepository")
 */
class ReponseProposee {

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="enonce", type="string", length=255)
	 */
	private $enonce;

	/**
	 * @var boolean
	 *
	 * @ORM\Column(name="valide", type="boolean")
	 */
	private $valide;

	/**
	 * @ORM\OneToMany(targetEntity="ReponseDonnee", mappedBy="reponseProposee", cascade={"persist"})
	 */
	private $reponsesDonnees;

	/**
	 * @ORM\ManyToOne(targetEntity="Question", cascade={"all"}, inversedBy="reponsesProposees")
	 * @ORM\JoinColumn(name="question_id", referencedColumnName="id", nullable=false)
	 */
	private $question;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->reponsesDonnees = new ArrayCollection();
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
	 * @return ReponseProposee
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
	 * Set valide
	 * @param boolean $valide
	 * @return ReponseProposee
	 */
	public function setValide($valide) {
		$this->valide = $valide;

		return $this;
	}

	/**
	 * Get valide
	 * @return boolean
	 */
	public function getValide() {
		return $this->valide;
	}

	/**
	 * Add reponsesDonnees
	 * @param ReponseDonnee $reponsesDonnees
	 * @return ReponseProposee
	 */
	public function addReponsesDonnee(ReponseDonnee $reponsesDonnees) {
		$this->reponsesDonnees[] = $reponsesDonnees;
		return $this;
	}

	/**
	 * Remove reponsesDonnees
	 * @param ReponseDonnee $reponsesDonnees
	 */
	public function removeReponsesDonnee(ReponseDonnee $reponsesDonnees) {
		$this->reponsesDonnees->removeElement($reponsesDonnees);
	}

	/**
	 * Get reponsesDonnees
	 * @return ArrayCollection
	 */
	public function getReponsesDonnees() {
		return $this->reponsesDonnees;
	}

	/**
	 * Set question
	 *
	 * @param Question $question
	 * @return ReponseProposee
	 */
	public function setQuestion(Question $question) {
		$this->question = $question;

		return $this;
	}

	/**
	 * Get question
	 * @return Question
	 */
	public function getQuestion() {
		return $this->question;
	}
}

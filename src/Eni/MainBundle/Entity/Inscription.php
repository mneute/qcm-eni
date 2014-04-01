<?php

namespace Eni\MainBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Inscription
 * @ORM\Table(name="inscription")
 * @ORM\Entity(repositoryClass="InscriptionRepository")
 */
class Inscription {

	/**
	 * @var integer
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @var \DateTime
	 * @ORM\Column(name="duree_validite", type="datetime")
	 */
	private $dureeValidite;

	/**
	 * @var \DateTime
	 * @ORM\Column(name="temps_ecoule", type="time", nullable=true)
	 */
	private $tempsEcoule;

	/**
	 * @var boolean
	 * @ORM\Column(name="etat", type="boolean")
	 */
	private $etat;

	/**
	 * @var integer
	 * @ORM\Column(name="resultat_obtenu", type="integer", nullable=true)
	 */
	private $resultatObtenu;

	/**
	 * @ORM\ManyToOne(targetEntity="Utilisateur", cascade={"all"}, inversedBy="inscriptions")
	 * @ORM\JoinColumn(name="utilisateur_id", referencedColumnName="id")
	 */
	private $utilisateur;

	/**
	 * @ORM\ManyToOne(targetEntity="Test", cascade={"all"}, inversedBy="inscriptions")
	 * @ORM\JoinColumn(name="test_id", referencedColumnName="id")
	 */
	private $test;

	/**
	 * @ORM\OneToMany(targetEntity="QuestionTirage", mappedBy="inscription", cascade={"persist"})
	 */
	private $questionTirages;

	/**
	 * Constructor
	 */
	public function __construct() {
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
	 * Set dureeValidite
	 * @param \DateTime $dureeValidite
	 * @return Inscription
	 */
	public function setDureeValidite($dureeValidite) {
		$this->dureeValidite = $dureeValidite;
		return $this;
	}

	/**
	 * Get dureeValidite
	 * @return \DateTime
	 */
	public function getDureeValidite() {
		return $this->dureeValidite;
	}

	/**
	 * Set tempsEcoule
	 * @param \DateTime $tempsEcoule
	 * @return Inscription
	 */
	public function setTempsEcoule($tempsEcoule) {
		$this->tempsEcoule = $tempsEcoule;
		return $this;
	}

	/**
	 * Get tempsEcoule
	 * @return \DateTime
	 */
	public function getTempsEcoule() {
		return $this->tempsEcoule;
	}

	/**
	 * Set etat
	 * @param boolean $etat
	 * @return Inscription
	 */
	public function setEtat($etat) {
		$this->etat = $etat;
		return $this;
	}

	/**
	 * Get etat
	 * @return boolean
	 */
	public function getEtat() {
		return $this->etat;
	}

	/**
	 * Set resultatObtenu
	 * @param string $resultatObtenu
	 * @return Inscription
	 */
	public function setResultatObtenu($resultatObtenu) {
		$this->resultatObtenu = $resultatObtenu;
		return $this;
	}

	/**
	 * Get resultatObtenu
	 * @return string
	 */
	public function getResultatObtenu() {
		return $this->resultatObtenu;
	}

	/**
	 * Set utilisateur
	 * @param Utilisateur $utilisateur
	 * @return Inscription
	 */
	public function setUtilisateur(Utilisateur $utilisateur = null) {
		$this->utilisateur = $utilisateur;
		return $this;
	}

	/**
	 * Get utilisateur
	 * @return Utilisateur
	 */
	public function getUtilisateur() {
		return $this->utilisateur;
	}

	/**
	 * Set test
	 * @param Test $test
	 * @return Inscription
	 */
	public function setTest(Test $test = null) {
		$this->test = $test;
		return $this;
	}

	/**
	 * Get test
	 * @return Test
	 */
	public function getTest() {
		return $this->test;
	}

	/**
	 * Add questionTirages
	 * @param QuestionTirage $questionTirages
	 * @return Inscription
	 */
	public function addQuestionTirage(QuestionTirage $questionTirages) {
		$this->questionTirages[] = $questionTirages;
		return $this;
	}

	/**
	 * Remove questionTirages
	 * @param QuestionTirage $questionTirages
	 */
	public function removeQuestionTirage(QuestionTirage $questionTirages) {
		$this->questionTirages->removeElement($questionTirages);
	}

	/**
	 * Get questionTirages
	 * @return ArrayCollection
	 */
	public function getQuestionTirages() {
		return $this->questionTirages;
	}
}

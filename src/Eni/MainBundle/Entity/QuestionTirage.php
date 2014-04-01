<?php

namespace Eni\MainBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * QuestionTirage
 *
 * @ORM\Table(name="question_tirage")
 * @ORM\Entity(repositoryClass="QuestionTirageRepository")
 */
class QuestionTirage {

	/**
	 * @var integer
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @var boolean
	 * @ORM\Column(name="est_marquee", type="boolean")
	 */
	private $estMarquee;

	/**
	 * @ORM\ManyToOne(targetEntity="Inscription", cascade={"all"}, inversedBy="questionTirage")
	 * @ORM\JoinColumn(name="inscription_id", referencedColumnName="id", nullable=false)
	 */
	private $inscription;

	/**
	 * @ORM\OneToMany(targetEntity="ReponseDonnee", mappedBy="questionTirage", cascade={"persist"})
	 */
	private $reponsesDonnees;

	/**
	 * @ORM\ManyToOne(targetEntity="Question", cascade={"all"}, inversedBy="questionTirages")
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
	 * Set estMarquee
	 * @param boolean $estMarquee
	 * @return QuestionTirage
	 */
	public function setEstMarquee($estMarquee) {
		$this->estMarquee = $estMarquee;

		return $this;
	}

	/**
	 * Get estMarquee
	 *
	 * @return boolean
	 */
	public function getEstMarquee() {
		return $this->estMarquee;
	}

	/**
	 * Set inscription
	 *
	 * @param Inscription $inscription
	 * @return QuestionTirage
	 */
	public function setInscription(Inscription $inscription) {
		$this->inscription = $inscription;

		return $this;
	}

	/**
	 * Get inscription
	 *
	 * @return Inscription
	 */
	public function getInscription() {
		return $this->inscription;
	}

	/**
	 * Add reponsesDonnees
	 * @param ReponseDonnee $reponsesDonnees
	 * @return QuestionTirage
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
     * @param \Eni\MainBundle\Entity\Question $question
     * @return QuestionTirage
     */
    public function setQuestion(\Eni\MainBundle\Entity\Question $question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return \Eni\MainBundle\Entity\Question 
     */
    public function getQuestion()
    {
        return $this->question;
    }
}

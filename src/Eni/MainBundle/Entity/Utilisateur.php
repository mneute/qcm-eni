<?php

namespace Eni\MainBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User;

/**
 * Utilisateur
 *
 * @ORM\Table(name="utilisateur")
 * @ORM\Entity(repositoryClass="UtilisateurRepository")
 */
class Utilisateur extends User {

	/**
	 * @var integer
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * @ORM\Column(name="nom", type="string", length=255, nullable=false)
	 */
	private $nom;

	/**
	 * @ORM\Column(name="prenom", type="string", length=255, nullable=false)
	 */
	private $prenom;

	/**
	 * @ORM\ManyToOne(targetEntity="Promotion", cascade={"all"}, inversedBy="utilisateurs")
	 * @ORM\JoinColumn(name="promotion_id", referencedColumnName="id", nullable=true)
	 */
	private $promotion;

	/**
	 * @ORM\ManyToMany(targetEntity="Test", inversedBy="utilisateurs")
	 * @ORM\JoinTable(name="utilisateur_test",
	 *      joinColumns={@ORM\JoinColumn(name="utilisateur_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@ORM\JoinColumn(name="test_id", referencedColumnName="id")}
	 *      )
	 */
	private $tests;

	/**
	 * @ORM\OneToMany(targetEntity="Inscription", mappedBy="utilisateur", cascade={"persist"})
	 */
	private $inscriptions;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
		$this->tests = new ArrayCollection();
		$this->inscriptions = new ArrayCollection();
	}

	/**
	 * Get id
	 * @return integer
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Set nom
	 * @param string $nom
	 * @return Utilisateur
	 */
	public function setNom($nom) {
		$this->nom = $nom;
		return $this;
	}

	/**
	 * Get nom
	 * @return string
	 */
	public function getNom() {
		return $this->nom;
	}

	/**
	 * Set prenom
	 * @param string $prenom
	 * @return Utilisateur
	 */
	public function setPrenom($prenom) {
		$this->prenom = $prenom;
		return $this;
	}

	/**
	 * Get prenom
	 * @return string
	 */
	public function getPrenom() {
		return $this->prenom;
	}

	/**
	 * Set promotion
	 * @param Promotion $promotion
	 * @return Utilisateur
	 */
	public function setPromotion(Promotion $promotion = null) {
		$this->promotion = $promotion;
		return $this;
	}

	/**
	 * Get promotion
	 * @return Promotion
	 */
	public function getPromotion() {
		return $this->promotion;
	}

	/**
	 * Add tests
	 * @param Test $tests
	 * @return Utilisateur
	 */
	public function addTest(Test $tests) {
		$this->tests[] = $tests;
		return $this;
	}

	/**
	 * Remove tests
	 * @param Test $tests
	 */
	public function removeTest(Test $tests) {
		$this->tests->removeElement($tests);
	}

	/**
	 * Get tests
	 * @return ArrayCollection
	 */
	public function getTests() {
		return $this->tests;
	}

	/**
	 * Add inscriptions
	 * @param Inscription $inscriptions
	 * @return Utilisateur
	 */
	public function addInscription(Inscription $inscriptions) {
		$this->inscriptions[] = $inscriptions;
		return $this;
	}

	/**
	 * Remove inscriptions
	 * @param Inscription $inscriptions
	 */
	public function removeInscription(Inscription $inscriptions) {
		$this->inscriptions->removeElement($inscriptions);
	}

	/**
	 * Get inscriptions
	 * @return ArrayCollection
	 */
	public function getInscriptions() {
		return $this->inscriptions;
	}

	/**
	 * Verifie si l'utilisateur est un formateur
	 * @return boolean
	 */
	public function estFormateur() {
		return in_array('ROLE_FORMATEUR', $this->getRoles());
	}

	/**
	 * Verifie si l'utilisateur est un administrateur
	 * @return boolean
	 */
	public function estAdministrateur() {
		return in_array('ROLE_ADMIN', $this->getRoles());
	}

	public function estStagiaire() {
		return !($this->estFormateur() || $this->estAdministrateur());
	}
}

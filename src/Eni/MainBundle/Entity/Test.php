<?php

namespace Eni\MainBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Test
 *
 * @ORM\Table(name="test")
 * @ORM\Entity(repositoryClass="TestRepository")
 */
class Test {

	/**
	 * @var integer
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @var string
	 * @ORM\Column(name="libelle", type="string", length=255)
	 */
	private $libelle;

	/**
	 * @var string
	 * @ORM\Column(name="description", type="string", length=255)
	 */
	private $description;

	/**
	 * @var integer
	 * @ORM\Column(name="duree", type="integer")
	 */
	private $duree;

	/**
	 * @var integer
	 * @ORM\Column(name="seuil", type="integer")
	 */
	private $seuil;

	/**
	 * @ORM\ManyToOne(targetEntity="Utilisateur", cascade={"all"}, inversedBy="tests")
	 * @ORM\JoinColumn(name="utilisateur_id", referencedColumnName="id", nullable=false)
	 */
	private $utilisateur;

	/**
	 * @ORM\OneToMany(targetEntity="Inscription", mappedBy="test", cascade={"persist"})
	 */
	private $inscriptions;

	/**
	 * @ORM\OneToMany(targetEntity="ThemeTest", mappedBy="test", cascade={"persist"})
	 */
	private $themeTests;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->inscriptions = new ArrayCollection();
		$this->themeTests = new ArrayCollection();
	}

	/**
	 * Get id
	 * @return integer
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Set libelle
	 * @param string $libelle
	 * @return Test
	 */
	public function setLibelle($libelle) {
		$this->libelle = $libelle;
		return $this;
	}

	/**
	 * Get libelle
	 * @return string
	 */
	public function getLibelle() {
		return $this->libelle;
	}

	/**
	 * Set description
	 * @param string $description
	 * @return Test
	 */
	public function setDescription($description) {
		$this->description = $description;
		return $this;
	}

	/**
	 * Get description
	 * @return string
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Set duree
	 * @param integer $duree
	 * @return Test
	 */
	public function setDuree($duree) {
		$this->duree = $duree;
		return $this;
	}

	/**
	 * Get duree
	 * @return integer
	 */
	public function getDuree() {
		return $this->duree;
	}

	/**
	 * Set seuil
	 * @param integer $seuil
	 * @return Test
	 */
	public function setSeuil($seuil) {
		$this->seuil = $seuil;
		return $this;
	}

	/**
	 * Get seuil
	 * @return integer
	 */
	public function getSeuil() {
		return $this->seuil;
	}

	/**
	 * Add inscriptions
	 * @param Inscription $inscriptions
	 * @return Test
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
	 * Add themeTests
	 * @param ThemeTest $themeTests
	 * @return Test
	 */
	public function addThemeTest(ThemeTest $themeTests) {
		$this->themeTests[] = $themeTests;
		return $this;
	}

	/**
	 * Remove themeTests
	 * @param ThemeTest $themeTests
	 */
	public function removeThemeTest(ThemeTest $themeTests) {
		$this->themeTests->removeElement($themeTests);
	}

	/**
	 * Get themeTests
	 * @return ArrayCollection
	 */
	public function getThemeTests() {
		return $this->themeTests;
	}

	/**
	 * Set utilisateur
	 * @param Utilisateur $utilisateur
	 * @return Test
	 */
	public function setUtilisateur(Utilisateur $utilisateur) {
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
}

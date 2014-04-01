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
	 * @ORM\ManyToMany(targetEntity="Utilisateur", mappedBy="tests")
	 */
	private $utilisateurs;

	/**
	 * @ORM\OneToMany(targetEntity="Inscription", mappedBy="test", cascade={"persist"})
	 */
	private $inscriptions;

	/**
	 * @ORM\OneToMany(targetEntity="SectionTest", mappedBy="test", cascade={"persist"})
	 */
	private $sectionTests;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->utilisateurs = new ArrayCollection();
		$this->inscriptions = new ArrayCollection();
		$this->sectionTests = new ArrayCollection();
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
	 * Add utilisateurs
	 * @param Utilisateur $utilisateurs
	 * @return Test
	 */
	public function addUtilisateur(Utilisateur $utilisateurs) {
		$this->utilisateurs[] = $utilisateurs;
		return $this;
	}

	/**
	 * Remove utilisateurs
	 * @param Utilisateur $utilisateurs
	 */
	public function removeUtilisateur(Utilisateur $utilisateurs) {
		$this->utilisateurs->removeElement($utilisateurs);
	}

	/**
	 * Get utilisateurs
	 * @return ArrayCollection
	 */
	public function getUtilisateurs() {
		return $this->utilisateurs;
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
	 * Add sectionTests
	 * @param SectionTest $sectionTests
	 * @return Test
	 */
	public function addSectionTest(SectionTest $sectionTests) {
		$this->sectionTests[] = $sectionTests;
		return $this;
	}

	/**
	 * Remove sectionTests
	 * @param SectionTest $sectionTests
	 */
	public function removeSectionTest(SectionTest $sectionTests) {
		$this->sectionTests->removeElement($sectionTests);
	}

	/**
	 * Get sectionTests
	 * @return ArrayCollection
	 */
	public function getSectionTests() {
		return $this->sectionTests;
	}
}

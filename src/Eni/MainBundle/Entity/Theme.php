<?php

namespace Eni\MainBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Theme
 *
 * @ORM\Table(name="theme")
 * @ORM\Entity(repositoryClass="ThemeRepository")
 */
class Theme {

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
	 * @ORM\OneToMany(targetEntity="Question", mappedBy="theme", cascade={"persist"})
	 */
	private $questions;

	/**
	 * @ORM\OneToMany(targetEntity="ThemeTest", mappedBy="theme", cascade={"persist"})
	 */
	private $themeTests;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->questions = new ArrayCollection();
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
	 * @return Theme
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
	 * Add questions
	 *
	 * @param Question $questions
	 * @return Theme
	 */
	public function addQuestion(Question $questions) {
		$this->questions[] = $questions;
		return $this;
	}

	/**
	 * Remove questions
	 *
	 * @param Question $questions
	 */
	public function removeQuestion(Question $questions) {
		$this->questions->removeElement($questions);
	}

	/**
	 * Get questions
	 * @return ArrayCollection
	 */
	public function getQuestions() {
		return $this->questions;
	}

	/**
	 * Add themeTests
	 * @param ThemeTest $themeTests
	 * @return Theme
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
}

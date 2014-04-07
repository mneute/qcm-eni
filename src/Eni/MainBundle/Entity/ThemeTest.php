<?php

namespace Eni\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ThemeTest
 *
 * @ORM\Table(name="theme_test")
 * @ORM\Entity(repositoryClass="ThemeTestRepository")
 */
class ThemeTest {

	/**
	 * @var integer
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @var integer
	 * @ORM\Column(name="nbQuestionsATirer", type="integer")
	 */
	private $nbQuestionsATirer;

	/**
	 * @ORM\ManyToOne(targetEntity="Theme", cascade={"all"}, inversedBy="themeTests")
	 * @ORM\JoinColumn(name="theme_id", referencedColumnName="id", nullable=false)
	 */
	private $theme;

	/**
	 * @ORM\ManyToOne(targetEntity="Test", cascade={"all"}, inversedBy="themeTests")
	 * @ORM\JoinColumn(name="test_id", referencedColumnName="id", nullable=false)
	 */
	private $test;

	/**
	 * Get id
	 * @return integer
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Set nbQuestionsATirer
	 * @param integer $nbQuestionsATirer
	 * @return ThemeTest
	 */
	public function setNbQuestionsATirer($nbQuestionsATirer) {
		$this->nbQuestionsATirer = $nbQuestionsATirer;
		return $this;
	}

	/**
	 * Get nbQuestionsATirer
	 * @return integer
	 */
	public function getNbQuestionsATirer() {
		return $this->nbQuestionsATirer;
	}

	/**
	 * Set theme
	 * @param Theme $theme
	 * @return ThemeTest
	 */
	public function setTheme(Theme $theme) {
		$this->theme = $theme;
		return $this;
	}

	/**
	 * Get theme
	 * @return Theme
	 */
	public function getTheme() {
		return $this->theme;
	}

	/**
	 * Set test
	 * @param Test $test
	 * @return ThemeTest
	 */
	public function setTest(Test $test) {
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
}

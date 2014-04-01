<?php

namespace Eni\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SectionTest
 *
 * @ORM\Table(name="section_test")
 * @ORM\Entity(repositoryClass="SectionTestRepository")
 */
class SectionTest {

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
	 * @ORM\ManyToOne(targetEntity="Theme", cascade={"all"}, inversedBy="sectionTests")
	 * @ORM\JoinColumn(name="theme_id", referencedColumnName="id", nullable=false)
	 */
	private $theme;

	/**
	 * @ORM\ManyToOne(targetEntity="Test", cascade={"all"}, inversedBy="sectionTests")
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
	 * @return SectionTest
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
	 * @return SectionTest
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
	 * @return SectionTest
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

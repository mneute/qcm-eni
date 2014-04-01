<?php

namespace Eni\MainBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Promotion
 * @ORM\Table(name="promotion")
 * @ORM\Entity(repositoryClass="PromotionRepository")
 */
class Promotion {

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
	 * @ORM\Column(name="libelle", type="string", length=255)
	 */
	private $libelle;

	/**
	 * @ORM\OneToMany(targetEntity="Utilisateur", mappedBy="promotion", cascade={"persist"})
	 */
	private $utilisateurs;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->utilisateurs = new ArrayCollection();
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
	 * @return Promotion
	 */
	public function setLibelle($libelle) {
		$this->libelle = $libelle;

		return $this;
	}

	/**
	 * Get libelle
	 *
	 * @return string
	 */
	public function getLibelle() {
		return $this->libelle;
	}

	/**
	 * Add utilisateurs
	 *
	 * @param Utilisateur $utilisateurs
	 * @return Promotion
	 */
	public function addUtilisateur(Utilisateur $utilisateurs) {
		$this->utilisateurs[] = $utilisateurs;

		return $this;
	}

	/**
	 * Remove utilisateurs
	 *
	 * @param Utilisateur $utilisateurs
	 */
	public function removeUtilisateur(Utilisateur $utilisateurs) {
		$this->utilisateurs->removeElement($utilisateurs);
	}

	/**
	 * Get utilisateurs
	 *
	 * @return ArrayCollection
	 */
	public function getUtilisateurs() {
		return $this->utilisateurs;
	}
}

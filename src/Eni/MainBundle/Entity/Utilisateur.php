<?php

namespace Eni\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User;

/**
 * Utilisateur
 *
 * @ORM\Table(name="utilisateur")
 * @ORM\Entity(repositoryClass="Eni\MainBundle\Entity\UtilisateurRepository")
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
}

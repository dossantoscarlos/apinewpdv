<?php

namespace Web\Http\Models\Entity;

use Doctrine\ORM\Annotation;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Web\Http\Models\IJsonSerializable;

/**
 * @Entity @Table(name="ceps")
 **/
class Cep {

	/**
	 * @Id
	 * @var int
	 * @Column(type="integer")
	 * @GeneratedValue
	 **/
	private $id;

	protected $cep;

	protected $rua;

	protected $estado;

	protected $cidade;

	protected $bairro;

	public function __construct(){}

	public function getId() : int {
		return $this->id;
	}

	public function getCep() : int {
		return $this->cep;
	}

	public function getRua(): String {
		return $this->rua;
	}

	public function getEstado() : String {
		return $this->estado;
	}

	public function getCidade() : String {
		return $this->cidade;
	}

	public function getBairro() : String {
		return $this->bairro;
	}
}

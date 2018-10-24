<?php

namespace App\Http\Models\Entity;

class Cep {

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

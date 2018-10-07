<?php
namespace App\Http\Models\Entity;

use Doctrine\Common\Annotation\Annotation;
use Doctrine\Common\Collections\ArrayCollection;

class Estoque {

	private $id;

	protected $qntAtual;

	protected $qntMinima;

	protected $qntRecebida;

	protected $produtos;

	public function __construct(){
			$this->produtos = new ArrayCollection ();
	}
	public function getId() : int {
		return $this->id;
	}

	public function getQntAtual() : int {
		return $this->qntAtual;
	}

	public function getQntMinima() : int {
		return $this->qntMinima;
	}

	public function getQntRecebida() : int {
		return $this->qntRecebida;
	}

	public function setQntAtual($qntAtual) {
		$this->qntAtual = $qntAtual;
	}
	
	public function setQntMinima($qntMinima){
		$this->qntMinima = $qntMinima;
	}

	public function setQntRecebida($qntRecebida) {
		$this->qntRecebida = $qntRecebida;
	}

}
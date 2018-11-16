<?php
namespace App\Http\Models\Entity;

use Doctrine\Common\Annotation\Annotation;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use App\Http\Models\IJsonSerializable;

class Estoque  extends EntityManager implements IJsonSerializable
{

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

	public function jsonSerialize() : array {
		return [
			'id' => $this->getId(),
			'quantidade_atual' => $this->getQntAtual(),
			'quantidade_recebida' => $this->getQntRecebida(),
			'quantidade_Minima' => $this->getQntMinima()
		];
	}
	public static function json($classe) : array {
		$result = null ;
		if (!empty($classe)){
			foreach ($classe as $key => $value) {
				$result[] = $classe[$key]->jsonSerialize();
			}
			return $result;
		}else {
			return array('Message' => 'Busca nao retornou resultados');
		}
	}
}

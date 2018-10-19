<?php

namespace App\Http\Models\Entity;

use Doctrine\ORM\Annotation;
use Doctrine\Common\Collections\ArrayCollection;
use App\Http\Models\IJsonSerializable;
use Doctrine\ORM\EntityManager;
/**
 * @Entity(repositoryClass="App\Http\Models\Repository\ProdutoRepository") @Table(name="Produtos")
 **/
class Produto extends EntityManager implements IJsonSerializable 
{
	/**
	 * @Id
	 * @var int
	 * @Column(type="integer")
	 * @GeneratedValue
	 **/
	protected $id;
	/**
	 * @var String
	 * @Column(type="string")
	 **/
	protected $nome;
	/**
	 * @var String
	 * @Column(type="string")
	 **/
	protected $tipo;
	/**
	 * @var int
	 * @Column(type="integer")
	 **/
	protected $code;

	protected $fornecedor;
	/**
	 * @var float
	 * @Column(type="float")
	 **/
	protected $kilo;
	/**
	 * @var int
	 * @Column(type="integer")
	 **/
	protected $unidade;
	/**
	 * @var float
	 * @Column(type="float")
	 **/
	protected $valor;

	public function __construct(){}
	
	public function getId(){
		return $this->id;
	}

	public function setNome($nome){
		$this->nome=$nome;
		return $this;
	}
	public function getNome():String{
		return $this->nome;
	}
	
	public function setTipo($tipo){
		$this->tipo = $tipo;
		return $this;
	}
	public function getTipo():String{
		return $this->tipo;
	}
	
	public function setCode($code){
		$this->code = $code;
		return $this;
	}
	public function getCode():int {
		return $this->code;
	}
	
	public function setKilo($kilo){
		$this->kilo = $kilo;
		return $this;
	}	
	public function getKilo():float{
		return $this->kilo;
	}
	
	public function setUnidade($unidade){
		$this->unidade = $unidade;
		return $this;
	}
	public function getUnidade():int{
		return $this->unidade;		
	}

	public function setValor($valor){
		$this->valor = $valor;
		return $this;
	}
	public function getValor():float{
		return $this->valor; 
	}
	
	public function jsonSerialize() : array
	{
		return [
			'id' => $this->getId(),
			'nome' => $this->getNome(),
			'tipo' => $this->getTipo(),
			'code' => $this->getCode(),
			'kilo' => $this->getKilo(),
			'unidade' => $this->getUnidade(),
			'valor' => $this->getValor()
		];
	}

	public static function json($classe) :array {
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
<?php

namespace Web\Http\Models\Entity;

use Doctrine\ORM\Annotation;
use Doctrine\Common\Collections\ArrayCollection;
use Web\Http\Models\IJsonSerializable;
use Doctrine\ORM\EntityManager;
/**
 * @Entity(repositoryClass="Web\Http\Models\Repository\ProdutoRepository") @Table(name="produtos")
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
	 * @var string
	 * @Column(type="string")
	 **/
	protected $nome;
	/**
	 * @var string
	 * @Column(type="string")
	 **/
	protected $tipo;

	/**
	 * @var int
	 * @Column(type="integer")
	 **/
	protected $codigoBarra;

	/**
	 * varios produtos pora um fornecedor.
	 * @ManyToOne(targetEntity="Fornecedor" , inversedBy="fornecedores")
	 **/
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

	public function __construct()
	{
		$this->fornecedor = new ArrayCollection();
	}

	public function getId(){
		return $this->id;
	}

	public function setNome($nome): Produto
	{
		$this->nome=$nome;
		return $this;
	}

	public function getNome():String
	{
		return $this->nome;
	}

	public function setTipo($tipo)  : Produto
	{
		$this->tipo = $tipo;
		return $this;
	}

	public function getTipo() : String
	{
		return $this->tipo;
	}

	public function setCodigoBarra($codigoBarra): Produto
	{
		$this->code = $codigoBarra;
		return $this;
	}
	public function getCodigoBarra():int {
		return $this->code;
	}

	public function setKilo($kilo): Produto
	{
		$this->kilo = $kilo;
		return $this;
	}
	public function getKilo() : float
	{
		return $this->kilo;
	}

	public function setUnidade($unidade) : Produto
	{
		$this->unidade = $unidade;
		return $this;
	}

	public function getUnidade():int{
		return $this->unidade;
	}

	public function setValor($valor) : Produto
	{
		$this->valor = $valor;
		return $this;
	}
	public function getValor() : float
	{
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

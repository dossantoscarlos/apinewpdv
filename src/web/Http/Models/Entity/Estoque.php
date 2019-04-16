<?php
namespace Web\Http\Models\Entity;

use Doctrine\ORM\Annotation;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Web\Http\Models\IJsonSerializable;

/**
 * @Entity(repositoryClass="Web\Http\Models\Repository\EstoqueRepository")
 * @Table(name="estoques")
 **/
class Estoque extends EntityManager implements IJsonSerializable
{
	/**
	 * @Id
	 * @var int
	 * @Column(type="integer")
	 * @GeneratedValue
	 **/
	private $id;

	/**
	 * @var int
	 * @Column(type="integer")
	 **/
	protected $qntAtual;

	/**
	 * @OneToOne(targetEntity="produto")
	 * @Column(unique=true)
	 **/
	protected $produtos;

	/**
	 * @var int
	 * @Column(type="integer")
	 **/
	protected $qntMinima;

  /**
	* @var int
 	* @Column(type="integer")
	**/
	protected $qntRecebida;


	public function __construct(){}


	public function getId() : int
	{
		return $this->id;
	}

	public function getQntAtual() : int
	{
		return $this->qntAtual;
	}

	public function getQntMinima() : int
	{
		return $this->qntMinima;
	}

	public function getQntRecebida() : int
	{
		return $this->qntRecebida;
	}

	public function setQntAtual($qntAtual) : void
	{
		$this->qntAtual = $qntAtual;
	}

	public function setQntMinima($qntMinima) : void
	{
		$this->qntMinima = $qntMinima;
	}

	public function setQntRecebida($qntRecebida) : void
	{
		$this->qntRecebida = $qntRecebida;
	}

	public function jsonSerialize() : array
	{
		return [
			'id' => $this->getId(),
			'quantidade_atual' => $this->getQntAtual(),
			'quantidade_recebida' => $this->getQntRecebida(),
			'quantidade_Minima' => $this->getQntMinima()
		];
	}

	public static function json($classe) : array
	{
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

<?php

namespace Web\Http\Models\Entity;

use Doctrine\ORM\Annotation;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Web\Http\Models\IJsonSerializable;

/**
 * @Entity(repositoryClass="Web\Http\Models\Repository\EnderecoRepository") @Table(name="enderecos")
 **/
class Endereco extends EntityManager implements IJsonSerializable
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
	 * @Column(type="integer", unique=true)
	 **/
	protected $cep;

	/**
	 * @var string
	 * @Column(type="string")
	 **/
	protected $rua;

	/**
	 * @var string
	 * @Column(type="string")
	 **/
	protected $estado;

	/**
	 * @var string
	 * @Column(type="string")
	 **/
	protected $cidade;

	/**
	 * @var string
	 * @Column(type="string")
	 **/
	protected $bairro;

	/**
		* varios enderecos tem uma Pesssoa. Este é o lado do dono.
		* @ManyToOne(targetEntity="Pessoa", inversedBy="pessoas")
		* @JoinColumn(name="pessoa_id", referencedColumnName="id")
		*/
	 private $pessoa;

	public function __construct(){}

	//funcoes getters e setters
	public function getId() : int {
		return $this->id;
	}

	public function setCep($cep): Cep {
		$this->cep = $cep;
		return $this;
	}

	public function getCep() : int {
		return $this->cep;
	}

	public function setRua($rua) : Cep
	{
		$this->rua = $rua;
		return $this;
	}

	public function getRua(): String
	{
		return $this->rua;
	}

	public function setEstado($estado) : Cep
	{
		$this->estado = $estado;
		return $this;

	}

	public function getEstado() : String
	{
		return $this->estado;
	}

	public function setCidade($cidade) : Cep {
		$this->cidade = $cidade;
		return $this;
	}

	public function getCidade() : String
	{
		return $this->cidade;
	}

	public function setBairro($bairro) : Cep {
		$this->bairro = $bairro;
		return $this;
	}

	public function getBairro() : String
	{
		return $this->bairro;
	}
//fim das funcoes get e set

	public function jsonSerialize() : array {
				return [
					'id' => $this->getId(),
					'cep' => $this->getCep(),
					'bairro' => $this->getBairro(),
					'cidade' => $this->getCidade(),
					'rua' => $this->getRua(),
					'estado' => $this->getEstado(),
				];
			}

			public static function json($classe) :array {
				$result = null ;
				if (!empty($classe)){
					foreach ($classe as $key => $value)
					{
						$result[] = $classe[$key]->jsonSerialize();
					}
					return $result;
				}else {
					return array('Message' => 'Busca nao retornou resultados');
				}
			}

}

<?php

namespace Web\Http\Models\Entity;

use Doctrine\ORM\Annotation;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Web\Http\Models\IJsonSerializable;

/**
 * @Entity @Table(name="enderecos")
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

	protected $cep;

	protected $rua;

	protected $estado;

	protected $cidade;

	protected $bairro;

	public function __construct(){}

		public function getId() : int {
			return $this->id;
		}

		public function jsonSerialize() : array {
			return [
				'id' => $this->getId(),
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

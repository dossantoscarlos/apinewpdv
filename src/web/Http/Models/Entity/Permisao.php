<?php
namespace Web\Http\Models\Entity;

use Doctrine\ORM\Annotation;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Web\Http\Models\IJsonSerializable;

/** 
 * @Entity @Table(name="permisao")
 **/
class Permisao extends EntityManager implements IJsonSerializable
{
	/**
	 * @Id
	 * @var int
	 * @Column(type="integer")
	 * @GeneratedValue
	 **/
	private $id;

	/**
	 * @var String
	 * @Column(type="string")
	 **/
	protected $acesso;

	/**
	 * @var String
	 * @Column(type="string")
	 **/
	protected $tipo;

	public function __construct(){}

	public function getId(){
		return $this->id;
	}

	public function getAcesso() : Array{
		return $this->acesso;
	}

	public function getTipo(): String {
		return $this->tipo;
	}

	public function setTipo($tipo) : void {
		$this->tipo = $tipo;
	}

	public function setAcesso($acesso) : void {
		$this->acesso[] = $acesso;
	}
	public function jsonSerialize() : array {
		return [
			'acesso' => $this->getAcesso()
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

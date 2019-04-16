<?php

namespace Web\Http\Models\Entity;

use Doctrine\ORM\Annotation;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Web\Http\Models\IJsonSerializable;

/**
 * @Entity
 * @Table(name="administradores")
 **/
class Administrador extends EntityManager implements IJsonSerializable
{
	/**
	 * @Id
	 * @var int
	 * @Column(type="integer")
	 * @GeneratedValue
	 **/
	private $id;

	protected $funcionario;

	protected $permissao;

	protected $status;


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
}

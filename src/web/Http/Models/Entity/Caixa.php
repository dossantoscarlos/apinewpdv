<?php
namespace Web\Http\Models\Entity;

use Doctrine\ORM\Annotation;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Web\Http\Models\IJsonSerializable;

/**
 * @Entity
 * @Table(name="caixas")
 **/
class Caixa extends EntityManager implements IJsonSerializable
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
	 **/
	protected $venda;
	/**
	 * @var int
	 **/
	protected $users;

	/**
	 * @var string
	 * @Column(type= "string")
	 **/
	protected $date;

	/**
	 * @var int
	 ****/
	protected $sangria;

	public function __construct(){

	}

	public function getId() : int
	{
		return $this->id;
	}

	public function getDate(): DateTime
	{
		return $this->date;
	}

	public function setDate(DateTime $date): void
	{
		$this->date = $date;
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

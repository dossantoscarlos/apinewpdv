<?php
namespace Web\Http\Models\Entity;

use Doctrine\ORM\Annotation;
use Doctrine\Common\Collections\ArrayCollection;
use Web\Http\Models\IJsonSerializable;
use Doctrine\ORM\EntityManager;
use Web\Cripto\BcryptCustom;

/** @Entity(repositoryClass="Web\Http\Models\Repository\UserRepository") @Table(name="users") **/
class User extends EntityManager implements IJsonSerializable {

   /**
	* @Id
	* @var int
	* @Column(type ="integer")
	* @GeneratedValue
	**/
	private $id;

	/**
	 * @var String
	 * @Column(type="string", unique=true)
	 **/
	protected $user;

	/**
	 * @var String
	 * @Column(type="string")
	 **/
	protected $passw;

	protected $status;

	protected $permision;

	protected $funcionarios;

	public function __construct(){}

	public function getId() : int
	{
		return $this->id;
	}

	public function setUser($user) : void
	{
		$this->user = $user;
	}

	public function getUser() : String
	{
		return $this->user;
	}

	public function getPassw() : String
	{
		return $this->passw;
	}

	public function setPassw($passw) : void
	{
		$this->passw = $passw;
	}

	public static function hashPassw($passw) : String
	{
		$bcryptCustom = new BcryptCustom();
		$hash = $bcryptCustom->cryptHash($passw);
		return $hash;
	}

	public function jsonSerialize() : array {
		return [
			'id' => $this->getId(),
			'user' => $this->getUser(),
		];
	}
  
	public static function json($classe): array {
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

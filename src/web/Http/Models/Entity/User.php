<?php
namespace Web\Http\Models\Entity;

use Doctrine\ORM\Annotation;
use Doctrine\Common\Collections\ArrayCollection;
use Web\Http\Models\IJsonSerializable;
use Doctrine\ORM\EntityManager;
use Web\Cripto\BcryptCustom;

/**
 * @Entity(repositoryClass="Web\Http\Models\Repository\UserRepository")
 * @Table(name="users")
 **/
class User extends EntityManager implements IJsonSerializable
{
 /**
	* @Id
	* @var int
	* @Column(type ="integer")
	* @GeneratedValue
	**/
	private $id;

	/**
	 * @var string
	 * @Column(type="string", unique=true)
	 **/
	protected $user;

	/**
	 * @var string
	 **/
	protected $loginIn;

	/**
	 * @var string
	 **/
	protected $loginOut;

	/**
	 * @var string
	 * @Column(type="string")
	 **/
	protected $passw;

	/**
	 * um user para uma Pessoa.
	 * @OneToOne(targetEntity="Pessoa", inversedBy="pessoas")
	 */
	private $pessoa;

	public function __construct(){}

	public function getId() : int
	{
		return $this->id;
	}

	public function setUser($user) : User
	{
		$this->user = $user;
		return $this;
	}

	public function getUser() : String
	{
		return $this->user;
	}

	public function getPassw() : String
	{
		return $this->passw;
	}

	public function setPassw($passw) : User
	{
		$this->passw = $passw;
		return $this;
	}

	public static function hashPassw($passw) : String
	{
		$bcryptCustom = new BcryptCustom();
		$hash = $bcryptCustom->cryptHash($passw);
		return $hash;
	}

	public function auth($classe) : array {
		$result=null;
		if (!empty($classe))
		{
			foreach ($classe as $key => $value)
			{
				$result[] = $classe[$key]->login();
			}
			return $result;
		} else {
			return ['error'=>true, 'Message' => 'Busca nao retornou resultados'];
		}
	}

	public function login() : array{
		return [
			'id' => $this->getId(),
			'user' => $this->getUser(),
			'pass' => $this->getPassw(),
		];
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
			return ['error'=>true, 'Message' =>'Busca nao retornou resultados'];
		}
	}
}

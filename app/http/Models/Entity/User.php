<?php 
namespace App\Http\Models\Entity;

use Doctrine\ORM\Annotation;
use Doctrine\Common\Collections\ArrayCollection;
use App\Http\Models\IJsonSerializable;
use Doctrine\ORM\EntityManager;

/** @Entity(repositoryClass="App\Http\Models\Repository\UserRepository") @Table(name="users") **/
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
	
	protected $permision;

	protected $funcionarios;

	public function __construct(){}
	
	public function getId() : int 
	{
		return $this->id;
	}

	public function setUser($user)
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

	public function setPassw($passw) 
	{
		$this->passw = $passw;
	}

	public function jsonSerialize() : array {
		return [
			'user' => $this->getUser(),
		];
	}
}
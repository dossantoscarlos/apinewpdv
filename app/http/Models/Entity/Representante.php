<?php 
namespace App\Http\Models\Entity;

use Doctrine\ORM\Annotation;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use App\Http\Models\IJsonSerializable;

/**
 * @Entity(repositoryClass="App\Http\Models\Repository\RepresentanteRepository") 
 * @Table(name="representantes")
 **/
class Representante extends EntityManager implements IJsonSerializable
{
	/**
	 * @Id
	 * @var Int
	 * @Column(type="integer")
	 * @GeneratedValue
	 **/
	protected $id;
	/**
	 * @var String
	 * @Column(type="string")
	 **/
	protected $nome; 
	/**
	 * @var String
	 * @Column(type="string")
	 **/
	protected $sobrenome;
	/**
	 * @var String
	 * @Column(type="string", unique=true)
	 **/
	protected $crachar;

	protected $fornecedor;

	public function __construct(){}
	
	public function getId(){
		return $this->id;
	}

	public function getNome() : String {
		return $this->nome;
	}
	public function setNome($nome){
		$this->nome = $nome;
		return $this;
	}

	public function getSobrenome() : String {
		return $this->sobrenome;
	}
	public function setSobrenome($sobrenome){
		$this->sobrenome = $sobrenome;
		return $this;
	}

	public function getCrachar() : String {
		return $this->crachar;
	}
	public function setCrachar($crachar){
		$this->crachar = $crachar;
		return $this;
	}

	public function jsonSerialize() : array
	{
		return [
			'id'=> $this->getId(),
			'nome' => $this->getNome(),
			'sobrenome' => $this->getSobrenome(),
			'crachar' => $this->getCrachar()
		];
	}

	public static function json($classe) : array {
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
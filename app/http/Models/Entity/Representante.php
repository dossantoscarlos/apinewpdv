<?php 
namespace App\Http\Models\Entity;

use Doctrine\ORM\Annotation;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use App\Http\Models\IJsonSerializable;

/**
 * @Entity(RepositoryClass="App\Http\Models\RepresentanteRepository") 
 * @Table(name="representantes")
 **/
class Representante extends EntityManager implements IJsonSerializable
{
	/**
	 * @Id
	 * @var Int
	 * @Column(type="Integer")
	 * @GeneratedValue
	 **/
	private $id;
	/**
	 * @var String
	 * @Column(type="String")
	 **/
	protected $nome; 
	/**
	 * @var String
	 * @Column(type="String")
	 **/
	protected $sobrenome;
	/**
	 * @var String
	 * @Column(type="String" unique="true")
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

	public function getCrachar() : int {
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
			'nome' => $this->sobrenome(),
			'crachar' => $this->crachar()
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
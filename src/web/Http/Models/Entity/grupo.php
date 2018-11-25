<?php 

namespace Web\Http\Models\Entity;

use Doctrine\ORM\Annotations;
use Doctrine\ORM\EntityManager;
use Web\Http\Models\IJsonSerializable;
/**
 * @Entity(repositoryClass="Web\Http\Models\Repository\FornecedorRepository") @Table(name="Fornecedores")
 **/
class grupo extends EntityManager implements IJsonSerializable 
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
	private $nome;
	/** 
	 * @var String
	 * @Column(type="string")
	 **/
	private $tipo;
	
	private $permisoes;

	public function __construct(){}

	public function getId() : int 
	{
		return $this->id;
	}

	public function getNome() : String 
	{
		return $this->nome;
	}

	public function  getTipo() : String 
	{
		return $this->tipo;
	}

	public function setNome($nome) : void 
	{
		$this->nome = $nome;
	}

	public function setTipo($tipo) : void 
	{
		$this->tipo = $tipo;
	}
	public function jsonSerialize() : array {
		return [];
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
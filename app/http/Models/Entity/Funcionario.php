<?php
namespace App\Http\Models\Entity;

use Doctrine\Common\Annotation\Annotation;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use App\Http\Models\IJsonSerializable;

/** 
 * @Entity (repositoryClass="App\Http\Models\Repository\FuncionarioRepository") 
 * @Table(name="funcionarios")
 **/
class Funcionario extends EntityManager implements IJsonSerializable
{
	/**
	 * @Id
	 * @var int
	 * @Column(type="integer")
	 * @GeneretedValue
	 **/
	private $id;

	/**
	 * @var String
	 * @Column(type="string")
	 **/
	protected $cargo;

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
	 * @var int
	 * @Column(type="integer")
	 **/
	protected $rg;

	/** 
	 * @var int
	 * @Column(type="integer")
	 **/
	protected $cpf;

	/** 
	 * @var int
	 * @Column(type="integer")
	 **/
	protected $cep;

	/** 
	 * @var int
	 * @Column(type="integer")
	 **/
	protected $numero;

	/** 
	 * @var String
	 * @Column(type="string")
	 **/
	protected $complemento;

	/** 
	 * @var String
	 * @Column(type="string")
	 **/
	protected $dataAdmissao;

	/** 
	 * @var String
	 * @Column(type="string" , unique=true)
	 **/
	protected $matricula;

	/** 
	 * @var String
	 * @Column(type="string")
	 **/
	protected $carteira;

	/** 
	 * @var int
	 * @Column(type="integer")
	 **/
	protected $pis;

	protected $permissoes;

	public function __construct(){}

	public function getId() : int {
			return $this->id;
	}

	public function getCargo() : String {
		return $this->cargo;
	}
	public function setCargo($cargo) : Void {
		$this->cargo = $cargo;
	}

	public function getNome() : String {
		return $this->nome;
	}
	public function setNome($nome) : Void {
			$this->nome = $nome ;
	}

	public function getSobrenome() : String {
		return $this->sobrenome;
	}
	public function setSobrenome($sobrenome) : Void {
		$this->sobrenome = $sobrenome ;
	}

	public function getRg() : String {
		return $this->rg;
	}
	public function setRg($rg) : Void {
		$this->rg = $rg;
	}

	public function getCpf() : int {
		return $this->cpf;
	}
	public function setCpf($cpf) : Void {
		$this->cpf = $cpf;
	}

	public function getNumero() : int {
		return $this->numero;
	}
	public function setNumero($numero) : Void {
		$this->numero = $numero;
	}

	public function getComplemento() : String {
		return $this->complemento;
	}
	public function setComplemento ($complemento) : Void {
		$this->complemento = $complemento;
	}

	public function getDataAdmissao() : String {
		return $this->dataAdmissao;
	}
	public function setDataAdmissao($dataAdmissao) : Void {
			$this->dataAdmissao = $dataAdmissao;
	}

	public function getMatricula() : String {
			return $this->matricula;
	}
	public function setMatricula ($matricula) : Void {
			$this->matricula = $matricula ;
	}

	public function getCarteira() : String {
		return $this->carteira;
	}
	public function setCarteira ($carteira) : Void {
		$this->carteira = $carteira ;
	}

	public function getPis() : int {
		return $this->pis;
	}
	public function setPis( $pis ) : Void {
		$this->pis = $pis;
	}

	public function jsonSerialize() : array {
		return [
			'id' => $this->getId(),
			'cargo' => $this->getCargo(),
			'nome' => $this->getNome(),
			'sobrenome' => $this->getSobrenome(),
			'rg' => $this->getRg(),
			'cpf' => $this->getCpf(),
			'numero' => $this->getNumero(),
			'complemento' => $this->getComplemento(),
			'data_admissao' => $this->getDataAdmisao(),
			'maricula' => $this->getMatricula(),
			'carteira' => $this->getCarteira(),
			'pis'=> $this->getPis()
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

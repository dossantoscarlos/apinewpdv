<?php 
namespace App\Http\Models\Entity;

use Doctrine\ORM\Annotation;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity @Table(name="Fornecedores")
 **/
class Fornecedor {
	
	/** @Id @Column(type="integer") @var int @GeneratedValue **/
	private $id;
	/** @Column(type="string") @var String **/
	protected $nome;
	/** @Column(type="string") @var String **/
	protected $cnpj;
	/** @Column(type="integer") @var int **/
	protected $numero;
	/** @Column(type="string") @var String  **/
	protected $complemento;
	/** @Column(type="string") @var String **/
	protected $razaoSocial;
	/** @Column(type="string") @var String **/
	protected $telefone;
	/** @Column(type="integer") @var int **/
	protected $cep;

	protected $representantes;

	public function __construct(){
			$this->representantes = new ArrayCollection();
	}

	public function getId() : int 
	{
		return $this->id;
	}

	public function getNome() : String 
	{ 
		return $this->$nome;
	}

	public function setNome($nome) 
	{
		$this->nome = $nome;
	}

	public function getCNPJ() : String 
	{
		return $this->cnpj;
	}

	public function setCNPJ($cnpj)
	{
		$this->cnpj = $cnpj;
	}

	public function getNumero() : String 
	{
		return $this->numero;
	}

	public function setNumero($numero)
	{
		$this->numero = $numero;
	}

	public function getComplemento() : String 
	{
		return $this->complemento;
	}

	public function setComplemento($complemento)
	{
		$this->complemento = $complemento; 
	}

	public function getRazaoSocial() : String 
	{
		return $this->razaoSocial;
	}

	public function setRazaoSocial($razaoSocial) 
	{
		$this->razaoSocial = $razaoSocial;
	}

	public function setTelefone ($telefone)
	{
		$this->telefone = $telefone;
	}
	public function getTelefone() : int 
	{
		return $this->telefone;
	}

	public function getCep() : int 
	{
		return $this->cep;
	} 

	public function setCep($cep)
	{
		return $this->cep = $cep;
	}

}
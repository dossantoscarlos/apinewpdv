<?php 
namespace App\Http\Models\Entity;

use Doctrine\Common\Annotation\Annotation;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

class Funcionario {
	
	private $id;	

	protected $cargo;

	protected $nome; 

	protected $sobrenome;

	protected $rg;

	protected $cpf;

	protected $cep;

	protected $rua;

	protected $numero;

	protected $complemento;

	protected $dataAdmisao;

	protected $matricula;

	protected $carteira;

	protected $pis;

	protected $permissoes;


}
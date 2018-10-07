<?php 
namespace App\Http\Models\Entity;

use Doctrine\ORM\Annotation;
use Doctrine\Common\Collections\ArrayCollection;



class Representante {
	
	private $id;

	protected $nome; 

	protected $sobrenome;

	protected $crachar;

	protected $fornecedor;

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
}
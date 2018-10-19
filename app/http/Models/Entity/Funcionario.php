<?php 
namespace App\Http\Models\Entity;

use Doctrine\Common\Annotation\Annotation;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;

class Funcionario extends EntityManager{
	
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
	
	public function __construct(){}

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
<?php
namespace App\Http\Models\Entity;

use Doctrine\ORM\Annotation;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;

class  Permisao extends EntityManager implements IJsonSerializable
{
	private $id;

	protected $acesso;

	public function __construct(){}

	public function getId(){
		return $this->id;
	}

	public function getAcesso() : Array{
		return $this->acesso;
	}

	public function setAcesso($acesso) {
		$this->acesso[] = $acesso;
		return $this;
	}
	public function jsonSerialize(){
		return [
			'acesso' => $this->getAcesso();
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

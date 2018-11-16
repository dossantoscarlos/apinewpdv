<?php 

namespace App\Http\Models\Entity;

use Doctrine\ORM\Annotations;
use Doctrine\ORM\EntityManager;
use App\Http\Models\IJsonSerializable;

class grupo extends EntityManager implements IJsonSerializable 
{
	private $id;

	private $nome;

	private $tipo;

	private $permisoes;

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
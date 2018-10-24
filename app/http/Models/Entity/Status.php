<?php

namespace App\Http\Models\Entity;

use Doctrine\ORM\Annotation;
use Doctrine\ORM\EntityManager;
use App\Http\Models\IJsonSerializable;

class Status extends EntityManager implements IJsonSerializable
{
  protected $id;

  protected $tipo;
  
  protected $users;

  public function __construct() {}

  public function getId() : int {
    return $this->id;
  }
  public function getTipo() : String {
    return $this->tipo;
  }
  public function jsonSerialize() : array
  {
    return [
      'id' => $this->getId(),
      'tipo' => $this->getTipo()
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

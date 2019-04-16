<?php

namespace Web\Http\Models\Entity;

use Doctrine\ORM\Annotation;
use Web\Http\Models\IJsonSerializable;

/**
 * @Entity
 * @Table(name="marcas")
 **/
class Marca implements IJsonSerializable
{
  /**
   * @Id
   * @var int
   * @Column(type="integer")
   * @GeneratedValue
   **/
   private $id;

   /**
    * @ManyToOne(targetEntity="Fornecedor")
    ***/
   private $fornecedor;

  /**
   * @var string
   * @column(type="string", unique=true)
   **/
  protected $nome;
  /**
   * @OneToMany(targetEntity="Representante", mappedBy="marca")
   **/
  private $representante;

  public function getId() : int {
    return $this->id;
  }

  public function setNome($nome) : Marca
  {
    $this->nome= $nome;
    return $this;
  }

  public function getNome() : String
  {
      return $this->nome;
  }

  public function jsonSerialize() : array {
    return [
        'id' => $this->getId(),
      ];
   }

   public static function json($classe) :array {
    $result = null ;
    if (!empty($classe)){
      foreach ($classe as $key => $value){
          $result[] = $classe[$key]->jsonSerialize();
      }
      return $result;
    }else {
        return array('Message' => 'Busca nao retornou resultados');
    }
  }
}

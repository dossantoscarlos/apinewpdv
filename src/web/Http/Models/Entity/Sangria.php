<?php
namespace Web\Http\Models\Entity;

use Doctrine\ORM\Annotation;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Web\Http\Models\IJsonSerializable;

/**
 * @Entity
 * @Table(name="sangrias")
 **/
class Sangria extends EntityManager implements IJsonSerializable
{
  /**
   * @Id
   * @var int
   * @Column(type="integer")
   * @GeneratedValue
   **/
  private $id;

}

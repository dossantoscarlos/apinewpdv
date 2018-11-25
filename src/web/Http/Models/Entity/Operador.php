<?php 

namespace Web\Http\Models\Entity;

/**
 * @Entity
 * @Table(name="operadores")
 **/
class Operador
{
	/**
	 * @Id
	 * @var int
	 * @Column(type="integer")
	 * @GeneratedValue
	 **/
	private $id;

}
<?php 

namespace Web\Http\Models\Entity;

/**
 * @Entity
 * @Table(name="administradores")
 **/
class Administrador 
{
	/**
	 * @Id
	 * @var int
	 * @Column(type="integer")
	 * @GeneratedValue
	 **/
	private $id;

}
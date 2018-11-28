<?php 
namespace Web\Http\Models\Entity;

/**
 * @Entity @Table(name="niveis")
 **/
class Nivel
{
	/**
	 * @Id
	 * @var int
	 * @Column(type="integer")
	 * @GeneratedValue
	 **/
	private $id;

}
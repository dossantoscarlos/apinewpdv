<?php

namespace Web\Http\Models\Entity;

/**
 * @Entity @Table(name="beneficios")
 **/
class Beneficio 
{
	/**
	 * @Id
	 * @var int
	 * @Column(type="integer")
	 * @GeneratedValue
	 **/
	private $id;

}
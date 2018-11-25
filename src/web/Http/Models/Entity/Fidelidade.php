<?php
namespace Web\Http\Models\Entity;
/**
 * @Entity
 * @Table(name="fidelidades")
 **/
class Fidelidade
{
	/**
	 * @Id
	 * @var int
	 * @Column(type="integer")
	 * @GeneratedValue
	 **/
	private $id;

}
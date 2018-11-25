<?php 
namespace Web\Http\Models\Entity;

/**
 * @Entity @Table(name="vendas") 
 **/
class Venda
{

	/**
	 * @Id
	 * @var int
	 * @Column(type="integer")
	 * @GeneratedValue
	 **/
	private $id;
}
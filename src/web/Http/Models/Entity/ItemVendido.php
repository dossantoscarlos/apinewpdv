<?php 
namespace Web\Http\Models\Entity;

/**
 * @Entity 
 * @Table(name="itensVendidos")
 **/
class ItemVendido
{
	
	/**
	 * @Id
	 * @var int
	 * @Column(type="integer")
	 * @GeneratedValue
	 **/
	private $id;

}
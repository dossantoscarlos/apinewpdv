<?php 
namespace Web\Http\Models\Entity;

/**
 * @Entity 
 * @Table(name="ItensVendidos")
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
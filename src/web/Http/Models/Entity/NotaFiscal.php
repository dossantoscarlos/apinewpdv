<?php 
	
namespace Web\Http\Models\Entity;

/** 
 * @Entity @Table(name="NotasFiscais")
 **/
class NotaFiscal {
	/**
	 * @Id
	 * @var int
	 * @Column(type="integer")
	 * @GeneratedValue
	 **/
	private $id;

}
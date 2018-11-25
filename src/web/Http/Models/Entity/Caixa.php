<?php 

namespace Web\Http\Models\Entity;


/**
 * @Entity @Table(name="caixas")
 **/
class Caixa {
	/**
	 * @Id
	 * @var int
	 * @Column(type="integer")
	 * @GeneratedValue
	 **/
	private $id;

}
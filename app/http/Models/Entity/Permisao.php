<?php
namespace App\Http\Models\Entity;

use Doctrine\Common\Annotation\Annotation;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

class Permisao
{
	private $id;

	protected $acesso;

	public function getAcesso() : Array{
		return $this->acesso;
	} 
	
	public function setAcesso($acesso) {
		$this->acesso[] = $acesso;
		return $this;
	}
}
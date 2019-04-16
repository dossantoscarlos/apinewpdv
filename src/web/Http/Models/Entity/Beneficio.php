<?php
namespace Web\Http\Models\Entity;

use Doctrine\ORM\Annotation;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Web\Http\Models\IJsonSerializable;
/**
 * @Entity(repositoryClass="Web\Http\Models\Repository\BeneficioRepository") @Table(name="beneficios")
 **/
class Beneficio extends EntityManager implements IJsonSerializable
{
	/**
	 * @Id
	 * @var int
	 * @Column(type="integer")
	 * @GeneratedValue
	 **/
private $id;
	/**
	 * @var string
	 * @Column(type="string")
	 **/
protected $tipo;

/**
	* @var string
	* @Column(type="string",unique=true)
	**/
 protected $matricula;
	/**
		* @var string
		* @Column(type="string")
		**/
	 protected $status;

	/**
	 * @ManyToOne(targetEntity="Funcionario", inversedBy="funcionarios")
	 **/
	protected $funcionario;

	public function getId() : int {
		return $this->id;
	}


	public function getTipo()  : String {
			return $this->tipo;
	}
	public function getMatricula() : String {
		return $this->matricula;
	}
	public function getStatus() : String {
		return $this->status;
	}

	public function setTipo($tipo) : Beneficio {
		$this->tipo = $tipo;
		return $this;
	}

	public function setMatricula($matricula) : Beneficio {
		$this->matricula = $matriula;
		return $this;
	}

	public function setStatus($status) : Beneficio {
		$this->status = $status;
		return $this;
	}

	public function jsonSerialize() : array {
		return [
			'id' => $this->getId(),
			'tipo' => $this->getTipo(),
			'matricula' => $this->getMatricula(),
			'status' => $this->getStatus()
		];
	}

	public static function json($classe) :array {
		$result = null ;
		if (!empty($classe)){
			foreach ($classe as $key => $value)
			{
				$result[] = $classe[$key]->jsonSerialize();
			}
			return $result;
		}else {
			return array('Message' => 'Busca nao retornou resultados');
		}
	}
}

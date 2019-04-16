<?php
namespace Web\Http\Models\Entity;

use Doctrine\ORM\Annotation;
use Doctrine\ORM\EntityManager;
use Doctrine\Common\Collections\ArrayCollection;
use Web\Http\Models\IJsonSerializable;

/**
 * @Entity(repositoryClass="Web\Http\Models\Repository\PessoaRepository") @Table(name="pessoas")
 **/
class Pessoa extends EntityManager implements IJsonSerializable
{
	/**
	 * @Id
	 * @Column(type="integer")
	 * @var int
	 * @GeneratedValue
	 **/
	private $id;
	/**
	 * @Column(type="string")
	 * @var string
	 **/
	protected $nome;
	/**
	 * @Column(type="string")
	 * @var string
	 **/
	protected $sobrenome;
	/**
	 * @Column(type="bigint", unique=true)
	 * @var int
	 **/
	protected $cpf;

	/**
	 * @Column(type="integer")
	 * @var int
	 **/
	protected $numero;
	/**
	 * @Column(type="string", nullable=true)
	 * @var string
	 **/
	protected $complemento;
	/**
	 * @Column(type="bigint")
	 * @var int
	 **/
	protected $tel;
	/**
	 * @Column(type="string")
	 * @var string
	 **/
	protected $email;

	/**
	 * um cep pertence a varios enderecos. Esse é o lado inverso.
	 * @OneToMany(targetEntity="Endereco", mappedBy="pessoas")
	 */
	private $endereco;

	/**
   * uma Pessoa para um User.
   * @OneToOne(targetEntity="User", mappedBy="users")
   */
  private $user;


	public function __construct() {
			$this->endereco = new ArrayCollection();
	}

	public function getId()
	{
		return $this->id;
	}

	public function getNumero() : int
	{
		return $this->numero;
	}
	public function getComplemento() : String
	{
		return $this->complemento;
	}

	public function getTel() : String
	{
		return $this->tel;
	}

	public function getEmail() : String
	{
		return $this->email;
	}

	public function getNome() : String
	{
		return $this->nome;
	}

	public function getSobrenome() : String
	{
		return $this->sobrenome;
	}

	public function getCPF() : String
	{
		return $this->cpf;
	}

	public function setCPF($cpf)
	{
		$this->cpf = $cpf;
	}

	public function setSobrenome($sobrenome)
	{
		$this->sobrenome = $sobrenome;
	}

	public function setNome($nome)
	{
		$this->nome = $nome;
	}

	public function setNumero($numero)
	{
		return $this->numero = $numero;
	}

	public function setComplemento($complemento)
	{
		return $this->complemento = $complemento;
	}

	public function setTel($tel)
	{
		return $this->tel = $tel;
	}

	public function setEmail($email)
	{
		return $this->email = $email;
	}

	public function jsonSerialize() : array
	{
		return [
			'id' => $this->getId(),
			'nome' => $this->getNome(),
			'sobrenome' => $this->getSobrenome(),
			'cpf' => $this->getCPF(),
			'numero' => $this->getNumero(),
			'complemento' => $this->getComplemento(),
			'tel' => $this->getTel(),
			'email' => $this->getEmail()
		];
	}

	public static function json($classe) :array {
		$result = null ;
		if (!empty($classe)){
			foreach ($classe as $key => $value) {
				$result[] = $classe[$key]->jsonSerialize();
			}
			return $result;
		}else {
			return array('Message' => 'Busca nao retornou resultados');
		}
	}
}

<?php 
namespace App\Http\Models\Repository;

use Doctrine\ORM\EntityRepository;
use App\Http\Models\Entity\Pessoa;
use Doctrine\ORM\ORMException;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

class PessoaRepository extends EntityRepository 
{

	public function findAllPessoas() : array 
	{
		return Pessoa::json($this->findAll());
	} 

	public function findPessoa($param) : array
	{
		$cQB = $this->_em->createQueryBuilder();
		$query = $cQB->select(array('p'))
			->from(Pessoa::class,'p')
			->where($cQB->expr()->orX(
					$cQB->expr()->like('p.nome', '?1'),
					$cQB->expr()->like('p.sobrenome', '?2'),
					$cQB->expr()->eq('p.cpf','?3')
				))->setParameter(1,$param->nome.'%')
			->setParameter(2,$param->sobrenome.'%')
			->setParameter(3,$param->cpf);
		$pessoa = $query->getQuery()->getResult();
		return Pessoa::json($pessoa);		
	}

	public function salvarPessoa($param) : int
	{
		try {
			$pessoa = new Pessoa();
			$pessoa->setNome($param->nome);
			$pessoa->setSobrenome($param->sobrenome);
			$pessoa->setCpf($param->cpf);
			$pessoa->setNumero($param->numero);
			$pessoa->setComplemento($param->complemento);
			$pessoa->setTel($param->tel);
			$pessoa->setEmail($param->email);
			$this->_em->persist($pessoa);
			$this->_em->flush();
			return 201;
		}catch(UniqueConstraintViolationException $ex){
			return 401;
		}
	}

	public function atualizarPessoa($obj,$req) : int
	{
		try{
			$findCPF= $this->findPessoa($obj);
			$pessoa = $this->find($findCPF[0]['id']);
			$pessoa->setNumero($req->numero);
			$pessoa->setComplemento($req->complemento);
			$pessoa->setTel($req->tel);
			$pessoa->setEmail($req->email);
			$this->_em->persist($pessoa);
			$this->_em->flush();
			return 200;
		}catch(ORMException $ex){
			return 204;
		}
	}

	public function deletarPessoa($param) : int
	{
		try{
			$pessoa = $this->findPessoa($param);
			$pessoaId = $this->find($pessoa[0]['id']);
			$this->_em->remove($pessoaId);
			$this->_em->flush();
			return 200;
		}catch(ORMException $ex){
			return 404;
		}
	}

	protected function convert($classe) : array 
	{
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
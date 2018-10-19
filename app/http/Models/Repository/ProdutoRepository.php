<?php 
namespace App\Http\Models\Repository;

use Doctrine\ORM\EntityRepository;
use App\Http\Models\Entity\Produto;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Doctrine\ORM\ORMException;


class ProdutoRepository Extends EntityRepository 
{
	//busca todos os produtos
	public function findProdutosAll() : array {
		$todos = $this->findAll();
		return Produto::json($todos);
	}
	
	public function findProdutos($param) : array {
		$cQB = $this->_em->createQueryBuilder();
		$query = $cQB->select(array('p'))
					 ->from(Produto::class , 'p')
					 ->where($cQB->expr()->orX(
					 	$cQB->expr()->like('p.nome','?1'),
					 	$cQB->expr()->eq('p.code','?2')
					 ))
					 ->setParameter(1, $param->nome)
					 ->setParameter(2,$param->code);
		$result = $query->getQuery()->getResult();
		return Produto::json($result);
	}

	public function createProduto($param) : int
	{		
		try{
			$produtos  =  new Produto();
			$produtos->setNome($param->nome);
			$produtos->setTipo($param->tipo);
			$produtos->setCode($param->code);
			$produtos->setKilo($param->kilo);
			$produtos->setUnidade($param->unidade);
			$produtos->setValor($param->valor);
			$this->_em->persist($produtos);
			$this->_em->flush(); 
			return 201;
		}catch(UniqueConstraintViolationException $ex){
			return 405;
		}
	}
	
	public  function updateProduto($code,$obj) : int
	{
		try{
			$findcode= $this->findProdutos($code);
			$produto = $this->find($findcode[0]['id']);
			$produto->setValor($obj->valor);
			$this->_em->persist($produto);
			$this->_em->flush();
			return 200;
		}catch(ORMException $ex){
			return 401;
		}
	}

	public function deletarProduto($code) : int
	{
		try{

			$findcode= $this->findProdutos($code);
			dump($code);
			$produto = $this->find($findcode[0]['id']);
			$this->_em->remove($produto);
			$this->_em->flush();
			return 200;
		}catch(ORMException $ex){
			echo $ex->getMessage();
			return 401;
		}
	}

}
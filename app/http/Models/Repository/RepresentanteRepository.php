<?php
namespace App\Http\Models\Repository;

use Doctrine\ORM\EntityRepository;
use App\Http\Models\Entity\Representante;
use Doctrine\ORM\ORMExecption;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\ORMInvalidArgumentException;

class RepresentanteRepository extends EntityRepository
{
	public function findAllRepresentantes () : array
	{
		return Representante::json($this->findAll());
	}

	public function findCracharRepresentante($crachar) : array
	{
		$qb = $this->_em->createQueryBuilder(); 

		$query = $qb->select('r')
					->from(Representante::class, 'r')
					->where($qb->expr()->like('r.crachar','?1'))
					->setParameter(1,$crachar->crachar.'%');

		$result = $query->getQuery()->getResult();
		
		return Representante::json($result);

	}
	public function salvarRepresentante($param): int
	{
		try{
			$r = new Representante();
			$r->setNome($param->nome);
			$r->setSobrenome($param->sobrenome);
			$r->setCrachar($param->crachar);
			
			$this->_em->persist($r);
			$this->_em->flush();

			return 201;
		}catch(ORMExecption | UniqueConstraintViolationException | ORMInvalidArgumentException $e)
		{
			return 402;
		}
	}

	public function removerRepresentante ($param) : int {
		try{
			$r = $this->findCracharRepresentante($param);
			$objectRepre = $this->find($r[0]['id']);	
			
			$this->_em->remove($objectRepre);
			$this->_em->flush();
			return 200;

		}catch(ORMExecption | UniqueConstraintViolationException | ORMInvalidArgumentException $e){
			return 404;
		}
	}
}
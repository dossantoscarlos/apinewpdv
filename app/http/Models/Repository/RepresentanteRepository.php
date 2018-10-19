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
		$repre = $this->findAll();
		return Representante::json($repre);
	}

	public function findCracharRepresentante($crachar) : array
	{
		$cQB = $this->_em->createQueryBuilder(); 
		$query = $cQB->select('r')->from(Representante::class, 'r')
		->where($cQB->expr()->eq('r.crachar','?1'))
		->setParameter(1,$crachar->numero);
		$result = $query->getQuery()->getResult();
		return Representante::json($result);
	}
	public function salvarRepresentante($param): int
	{
		try{
			$r = new Representante();
			$r->setNome($param->nome);
			$r->setSobrenome($param->sobrenome);
			$r->setCrachar($param->numero);

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
			$this->remove($objectRepre);
			$this->flush();
			return 204;
		}catch(ORMExecption | UniqueConstraintViolationException | ORMInvalidArgumentException $e){
			return 404;
		}
	}
}
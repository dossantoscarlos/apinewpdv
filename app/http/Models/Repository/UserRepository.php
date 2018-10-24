<?php 

namespace App\Http\Models\Repository;

use Doctrine\ORM\EntityRepository;
use App\Http\Models\Entity\User;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Doctrine\ORM\ORMException;


class UserRepository  extends EntityRepository
{
	public function findUserAll() :array 
	{
		return User::json($this->findAll());
	}
	
	public function findUser($param) : array
	{
		$qB = $this->_em->createQueryBuilder();
		$query = $qB->select(array('p'))
					->from(User::class, 'p')
					->where(
						$qB->expr()->like('p.user','?1')
					)->setParameter(1,$param->user.'%');
		$result = $query->getQuery()->getResult();
		 return User::json($result);
	}

	public function atualizarUser($obj,$value) : int 
	{
		try{
			
			$user = $this->findUser($obj);
			$userUpdate = $this->find($user[0]['id']);
			$userUpdate->setPassw(User::hashPassw($value->passw));
			
			$this->_em->persist($userUpdate);
			$this->_em->flush();

			return 200;

		}catch(ORMException | ORMInvalidArgumentException $ex){
			
			return 302;
		}
	}
	public function removeUser($param): int
	{
		try{
			$user = $this->findUser($param);
			$userFinds = $this->find($user[0]['id']);
			
			$this->_em->remove($userFinds);
			$this->_em->flush();
			
			return 200;
		
		}catch(ORMException | ORMInvalidArgumentException $ex) {
			return 404;
		}
	}
	public function salvarUser($param) : int
	{
		try{
			$user = new User(); 
		 	$user->setUser($param->user);
		 	$user->setPassw(User::hashPassw($param->passw));
		 	$this->_em->persist($user);
		 	$this->_em->flush();
		 	return 201;
		
		}catch(ORMException | UniqueConstraintViolationException | ORMInvalidArgumentException $ex){
			echo $ex->getMessage();
			return 302;
		}
	}

	
}
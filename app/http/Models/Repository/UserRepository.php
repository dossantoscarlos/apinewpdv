<?php 

namespace App\Http\Models\Repository;

use Doctrine\ORM\EntityRepository;
use App\Http\Models\Entity\User;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Doctrine\ORM\ORMException;
use App\Cripto\BcryptCustom;

class UserRepository  extends EntityRepository
{
	public function findUserAll() {
		$users = $this->findAll();
		return User::json($users);
	}
	
	public function findUser($param) : array {
		$qB = $this->_em->createQueryBuilder();
		$query = $qB->select(array('p'))
					->from(User::class, 'p')
					->where(
						$qB->expr()->eq('p.user','?1')
					)->setParameter(1,$param->user);
		$result = $query->getQuery()->getResult();
		 return User::json($result);
	}

	public function atualizarUser($obj,$value) : int 
	{
		try{
			$bcryptCustom = new BcryptCustom();			
			$hash = $bcryptCustom->cryptHash($value->passw);
			$user = $this->findUser($obj);
			$userFinds = $this->find($user[0]['id']);
			$userFinds->setPassw($hash);
			$this->_em->persist($userFinds);
			$this->_em->flush();
			return 200;
		}catch(ORMException | ORMInvalidArgumentException $ex){
			echo $ex->getMessage();
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
		}catch(ORMException | ORMInvalidArgumentException $ex)
		{
			return 404;
		}
	}
	public function salvarUser($param) : int
	{
		try{
			$user = new User(); 
			$bcryptCustom = new BcryptCustom();			
			$value = $bcryptCustom->cryptHash($param->passw);
			$param->passw = $value;
		 	$user->setUser($param->user);
		 	$user->setPassw($param->passw);
		 	$this->_em->persist($user);
		 	$this->_em->flush();
		 	return 201;
		
		}catch(ORMException | UniqueConstraintViolationException | ORMInvalidArgumentException $ex){
			echo $ex->getMessage();
			return 302;
		}
	}

	
}
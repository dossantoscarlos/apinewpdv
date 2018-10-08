<?php 

namespace App\Http\Models\Repository;

use Doctrine\ORM\EntityRepository;
use App\Http\Models\Entity\User;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Doctrine\ORM\ORMException;

class UserRepository  extends EntityRepository
{
	public function findUserAll(){
		$users = $this->findAll();
		return $this->convert($users);
	}

	public function findUser($param) : array {
		$qB = $this->_em->createQueryBuilder();
		$query = $qB->select(array('p'))
					->from(User::class, 'p')
					->where(
						$qB->expr()->eq('p.user','?1')
					)->setParameter(1,$param->user);
		$result = $query->getQuery()->getResult();
		return $this->convert($result);
	}

	public function atualizarUser() : int {

		return 200;
	}

	public function salvarUser($param) : int
	{
		try{
			$user = new User();
		 	$user->setUser($param->user);
		 	$user->setPassw($param->passw);
		 	$this->_em->persist($user);
		 	$this->_em->flush();
		 	return 201;
		}catch(ORMException | UniqueConstraintViolationException $ex){
			echo $ex->getMessage();
			return 302;
		}
	}

	protected function convert($classe) : array {
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
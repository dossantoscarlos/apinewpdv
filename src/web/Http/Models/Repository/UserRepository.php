<?php

namespace Web\Http\Models\Repository;

use Doctrine\ORM\EntityRepository;
use Web\Http\Models\Entity\User;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Doctrine\ORM\ORMException;

//classe contento as query de user model
class UserRepository  extends EntityRepository
{

	//busca todos os usuarios
 	public function findUserAll() :array
	{
		//convert o metodo findAll() em array
		return User::json($this->findAll());
	}

	//retorna um user
	public function findUserAuth($param) : array
	{
		//instacia da EntityManager
		$qB = $this->_em->createQueryBuilder();

		//query de consulta
		$q = $qB->select(array('p'))
					->from(User::class, 'p')
					->where(
						$qB->expr()->eq('p.user','?1')
					)->setParameter(1,$param->user);

		//resultado da consulta
		$result = $q->getQuery()->getResult();

		//convert em array
		return User::auth($result);
	}

	//busca usuarios apartir de um trecho do nome
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

	//atualiza um user
	public function atualizarUser($obj,$value) : int
	{
		//tratando exceptions
		try{
			//busca um user
			$user = $this->findUserAuth($obj);

			//cria um objeto do tipo EntityManager
			$u = $this->find($user[0]['id']);

			//codifica a senha
			$u->setPassw(User::hashPassw($value->passw));

			//prepara as alteracoes
			$this->_em->persist($u);

			//valida as  auteracoes
			$this->_em->flush();

			//retorna um codigo de sucesso
			return 200;

		}catch(ORMException | ORMInvalidArgumentException $ex){
			//retorna um codigo de error
			return 302;
		}
	}

	//remove usuario
	public function removeUser($param): int
	{
		try{

			$user = $this->findUserAuth($param);

			$userFinds = $this->find($user[0]['id']);

			$this->_em->remove($userFinds);

			$this->_em->flush();

			return 200;

		}catch(ORMException | ORMInvalidArgumentException $ex) {

			return 404;

		}
	}

	//cria um novo usuario
	public function salvarUser($param) : int
	{
		try{
			//instancia user
			$user = new User();
			//invoca os metodos de user
		 	$user->setUser($param->user);
		 	$user->setPassw(User::hashPassw($param->passw));

			//prepara os dados
			$this->_em->persist($user);

			//validada os dados
			$this->_em->flush();

			//retorna codigo de sucesso
		 	return 204;

		}catch(ORMException | UniqueConstraintViolationException | ORMInvalidArgumentException $ex){

			//retorna codigo de erro
			return 302;

		}
	}
}

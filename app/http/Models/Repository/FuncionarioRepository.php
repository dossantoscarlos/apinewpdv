<?php

namespace App\Http\Models\Repository;

use Doctrine\ORM\EntityRepository;
use App\Http\Models\Entity\Funcionario;

class FuncionarioRepository extends EntityRepository
{
   public function findAllFuncionarios() : array 
   {
   	return Funcionario::json($this->findAll());
   }  

   public function findFuncionario($obj) : array 
   {
      $qb = $this->_em->createQueryBuilder();
      $f = $qb->select(array('f'))
              ->from(Funcionario::class, 'f')
              ->where($qb->expr()->like('f.matricula' , '?1'))
              ->setParameter(1 , $obj->matr);
      $result = $f->getQuery()->getResult();

   	return Funcionario::json($result);
   }

   public function atualizaFuncionario ( $obj ) : int 
   {
      $fu = $this->findFuncionario($obj);
      $f = $this->find($fu[0]['id']);
      $f->setCep($obj->cep);
      $f->setNumero($obj->numero);
      if (isset($obj->complemento) ):
        $f->setComplemento($obj->complemento); 
      endif;
      return 204;
   }

   public function salvaFuncioanrio ($obj) : int 
   {
   		$f = new Funcionario();
         $f->setCargo($obj->cargo);
         $f->setNome($obj->nome);
         $f->setSobrenome($obj->sobrenome);
         $f->setRg($obj->rg);
         $f->setCpf($obj->cpf);
         $f->setCep($obj->cep);
         $f->setNumero($obj->numero);
         if (isset($obj->complemento)):
            $f->setComplemento($obj->complemento); 
         endif;
         $f->setDataAdmissao($obj->data_admissao);
         $f->setMatricula($obj->matricula);
         $f->setCarteira($obj->carteira);
         $f->setPis($obj->pis);

         $this->_em->persist($f);
         $this->_em->flush();

         return 201;
   } 

   public function removeFuncionario ($obj) : int 
   {
      $f = $this->findFuncionario($obj);
      $id = $this->find($f[0]['id']);

      $this->_em->remove($id);
      $this->_em->flush();
   	
      return 204;
   }
}
<?php

namespace App\Http\Models\Repository;

use Doctrine\ORM\EntityRepository;
use App\Http\Models\Entity\Fornecedor;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Doctrine\ORM\ORMException;

class FornecedorRepository extends EntityRepository
{
  public function findAllFornecedores() : array
  {
    return Fornecedor::json($this->findAll());
  }

  public function findFornecedorCnpj($obj) : array
  {
    $find = $this->_em->createQueryBuilder();
    $query = $find->select(array('f'))
    ->from(Fornecedor::class,'f')
    ->where($find->expr()->like('f.cnpj','?1'))
    ->setParameter(1,$obj->cnpj);
    $result = $query->getQuery()->getResult();
    return Fornecedor::json($result);
  }

  public function salvarFornecedor ($obj) : int
  {
    try
    {
      $f = new Fornecedor();
      $f->setNome($obj->nome);
      $f->setTelefone($obj->telefone);
      $f->setCNPJ($obj->cnpj);
      $f->setNumero($obj->numero);
      $f->setRazaoSocial($obj->razaoSocial);
      $f->setCep($obj->cep);
      $f->setComplemento($obj->complemento);

      $this->_em->persit($f);
      $this->_em->flush();

      return 201;
    }catch(ORMException $e){
      return 302;
    }
  }
  public function removeFornecedor($obj) : int 
  {
    $fId = $this->findFornecedorCnpj($obj->cnpj);
    $f = $this->find($fId[0]['id']);
    
    $this->_em->remove($f);
    $this->_em->flush();

    return 204;
  }

  public function updateFornecedor ($obj) : int 
  {
    $f = new Fornecedor(); 
    $f->setCep($obj->cep);
    $f->setNumero($obj->numero);
    $f->setComplemento($obj->complemento);
    $f->setTelefone($obj->telefone);

    $this->_em->persist($f);
    $this->_em->fulsh();

    return 204;

  }
}

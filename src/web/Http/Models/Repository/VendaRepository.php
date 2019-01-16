<?php
namespace Web\Http\Models\Repository;

use Doctrine\ORM\EntityRepository;
use Web\Http\Models\Entity\Venda;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Doctrine\ORM\ORMException;

class VendaRepository extends EntityRepository
{
  public function findAllVendas() : array
  {
    return Vanda::json($this->findAll());
  }

  public function findVenda($obj) : array
  {
    $find = $this->_em->createQueryBuilder();
    $query = $find->select(array('v'))
    ->from(Venda::class,'v')
    ->where($find->expr()->like('v.id','?1'))
    ->setParameter(1,$obj->cnpj);
    $result = $query->getQuery()->getResult();
    return Venda::json($result);
  }

  public function salvarVenda ($obj) : int
  {
    return 204;
  }

}

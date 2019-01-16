<?php
namespace Web\Http\Models\Repository;

use Doctrine\ORM\EntityRepository;
use Web\Http\Models\Entity\NotaFiscal;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Doctrine\ORM\ORMException;

class NotaFiscalRepository extends EntityRepository
{
  public function findAllNotasFiscais() : array
  {
    return NotaFiscal::json($this->findAll());
  }

  public function findNotaFiscal($obj) : array
  {
    $find = $this->_em->createQueryBuilder();
    $query = $find->select(array('nf'))
    ->from(NotaFiscal::class,'nf')
    ->where($find->expr()->like('nf.id','?1'))
    ->setParameter(1,$obj->cnpj);
    $result = $query->getQuery()->getResult();
    return NotaFiscal::json($result);
  }

  public function salvarNotaFiscal ($obj) : int
  {
    return 204;
  }

}

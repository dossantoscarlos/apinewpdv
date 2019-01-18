<?php
namespace Web\Http\Models\EntityRepository;

use Doctrine\ORM\EntityRepository;
use Web\Http\Models\Entity\Comprovante;

class ComprovanteRepository extends EntityRepository implements IRepository
{
  public function show() : array
  {
    return Comprovante::json($this->findAll());
  }

  public function find($obj) : array
  {
    return ["code" => 200];
  }

  public function create($obj): int
  {
    return 201;
  }

  public function update($obj) : int
  {
      return 204;
  }

  public function remove($obj) : int
  {
      return 204;
  }
}

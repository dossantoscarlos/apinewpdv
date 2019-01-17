<?php
namespace Web\Http\Models\Repository;

//doctrines
use Doctrine\ORM\EntityRepository;
//modelos
use Web\Http\Models\Entity\Administrador;

class AdministradorRepository extends EntityRepository implements IRepository
{
    public function show() : array
    {
      return ["code" => 200];
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

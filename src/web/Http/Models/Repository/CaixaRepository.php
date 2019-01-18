<?php
 namespace Web\Http\Models\Repository;

//Doctrine
 use Doctrine\ORM\EntityRepository;
 use Doctrine\ORM\ORMInvalidArgumentException;
 use Doctrine\ORM\ORMException;

 //entity
 use Web\Http\Models\Entity\Caixa;

 class CaixaRepository extends EntityRepository implements IRepository
 {
   public function show() : array
   {
     return Caixa::json($this->findAll());
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

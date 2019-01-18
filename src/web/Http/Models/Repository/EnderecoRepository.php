<?php
 namespace Web\Http\Models\Repository;

 use Doctrine\ORM\EntityRepository;
 use Web\Http\Models\Entity\Endereco;

 class EnderecoRepository extends EntityRepository implements IRepository
 {
   public function show() : array
   {
     return Endereco::json($this->findAll());
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

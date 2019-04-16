<?php
 namespace Web\Http\Models\Repository;

 use Doctrine\ORM\EntityRepository;
 use Web\Http\Models\Entity\Beneficio;

 class BeneficioRepository extends EntityRepository implements IRepository
 {
   //retorna todos os beneficios cadastrados
   public function show() : array
   {
     //retorna todos os objetos
     return Beneficio::json($this->findAll());
   }

   public function findEntity($obj) : array
   {
     $find = $this->_em->createQueryBuilder();

     $query = $find->select(array('b'))
              ->from(Beneficio::class, 'b')
              ->where($find->expr()->like('b.id','?1'))
              ->setParameter(1,$obj->id);

     $result = $query->getQuery()->getResult();

     return Beneficio::json($result);
   }

   public function create($obj): int
   {
     $b = new Beneficio;
     $b->getId();
     $this->_em->persist($b);
     $this->_em->flush();

     return 204;
   }

   public function update($obj) : int
   {

     $b = $this->findEntity($obj);
     //altera as query
     $u = $this->find($b[0]['id']);
     $u->setTipo($obj->tipo)
       ->setMatricula($obj->matricula)
       ->setStatus($obj->status)
       ->getId();

     $this->_em->persist($u);
     $this->_em->flush();

     return 204;
   }

   public function remove($obj) : int
   {
     $b = new Beneficio;
     $query = $this->findEntity($obj);
     $find = $this->find($query->id);
     $this->_em->remove($find);
     $this->_em->flush();
     return 204;
   }
 }

<?php
namespace Web\Http\Models\Repository;

//doctrines
use Doctrine\ORM\EntityRepository;
//modelos
use Web\Http\Models\Entity\Administrador;

//classe responsalvel por fazer alteracoes no banco de dados
class AdministradorRepository extends EntityRepository implements IRepository
{
    // seleciona todos os administradores
    public function show() : array
    {
      // retorna um array para ser usando com o json
      return Administrador::json($this->findAll());
    }

    //seleciona um administrador especifico
    public function findEntity($obj) : array
    {
      //cria um instancia do EntityManager
      $find = $this->_em->createQueryBuilder();

      //executa uma query do EntityManager
      $query = $find->select(array('adm'))
              ->from(Administrador::class, 'adm')
              ->where($find->expr()->like('adm.id','?1'))
              ->setParameter(1, $obj->id);

      //percorre a query e gera um resultado
      $result = $query->getQuery()->getResult();

      //retorna array
      return Administrador::json($result);
    }

    // cria um novo administrador
    public function create($obj): int
    {
      $a = new Administrador;

      $this->_em->persist($a);
      $this->_em->flush();

      return 201;
    }

    //atualiza as informacoes do administrador
    public function update($obj) : int
    {
        //procura o administrador
        $f = $this->findEntity($obj);

        //obtem um objeto para  o persist
        $u = $this->find($f[0]['id']);

        //parametros para fazer a aturalizacao
        $u->getId();

        //cria a persitencia no banco de dados
        $this->_em->persist($u);

        //valida a persitencia
        $this->_em->flush();

        return 204;
    }

    //remove o administrador
    public function remove($obj) : int
    {
        //executa a query de busca por matricula
        $a = $this->findEntity($obj);

        //retorna um objeto EntityManager
        $q = $this->find($a[0]['id']);

        //remove o administrador
        $this->_em->remove($q);

        //valida a solicitacao do metodo remove
        $this->_em->flush();

        return 204;
    }
}

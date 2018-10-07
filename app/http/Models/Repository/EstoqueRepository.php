<?php 
namespace App\Http\Models\Repository;

use Doctrine\ORM\EntityRepository;

class EstoqueRepository extends EntityRepository
{
	
	protected function  qntdMin($codeProduto) : int {
		$resultado = $codeProduto;
		return $resultado;
	}

	protected function  qntdAtual($codeProduto) : int {
		$resultado = $codeProduto;
		return $resultado;
	}

	protected function  qntdRecebida($codeProduto) : int {
		$resultado = $codeProduto;
		return $resultado;
	}
}
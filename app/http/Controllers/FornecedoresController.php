<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Interfaces\IApiDAO;
use App\Http\Models\Entity\Fornecedor;

class FornecedoresController extends Controller implements IApiDAO
{

	public function show ($request, $response, $args){
		$query = $request->getUri()->getQuery();
		if(!empty($query)){
			$find = $this->orm->getRepository(Fornecedor::class)->findFornecedorCnpj($query);
			return $this->response->withJson($find);
		}else{
			$find = $this->orm->getRepository(Fornecedor::class)->findAllFornecedores();
			return $this->response->withJson($find,200);
		}
	}

	public function create ($request, $response, $args){
		return $this->response->withStatus(200);
	}

	public function drop ($request, $response, $args){
		return $this->response->withStatus(200);
	}

	public function update ($request, $response, $args){
		return $this->response->withStatus(200);
	}
}

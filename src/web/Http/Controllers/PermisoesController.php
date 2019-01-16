<?php
namespace Web\Http\Controllers;

use Web\Http\Constroller\Interfaces\IApiDAO;
use Web\Http\Models\Entity\Permisao;

class PermisaoController extends Controller implements IApiDAO
{

	public function show ($request, $response, $args){
		return $this->response->withStatus(200);
	}

	public function select ($request, $response, $args){
		return $this->response->withStatus(200);
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

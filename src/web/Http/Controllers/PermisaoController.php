<?php 

namespace Web\Controllers;

use Web\Http\Models\Interfaces\IApiDAO;

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
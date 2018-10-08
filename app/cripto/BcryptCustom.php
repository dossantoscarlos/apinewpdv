<?php

namespace App\Cripto;

class BcryptCustom {

	private $salt = "Cf2f98eMArKYBJomM0F6aJ";

	private $custo = "10";

	public function cryptHash($senha) : String 
	{
		return $hash = crypt($senha, '$2a$' . $this->custo . '$' . $this->salt . '$');
	}

	public function verificaHash($hash, $senha) : Boolean
	{
		return (crypt($senha,$hash)) ? true : false;
	}
}	
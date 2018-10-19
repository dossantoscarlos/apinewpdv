<?php

namespace App\Cripto;

class BcryptCustom {

	private $salt = "Cf2f98eMArKYBJomM0F6aJ";

	private $custo = "08";

	public function cryptHash($senha) : String 
	{
		return crypt($senha, '$2a$' . $this->custo . '$' . $this->salt . '$');
	}

	public function verificaHash($hash, $senha) : Boolean
	{
		return (crypt($senha,$hash)) ? true : false;
	}
}	
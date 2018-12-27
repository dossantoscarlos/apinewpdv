<?php

  namespace Web\Http\Controllers\Auth;

  use Web\Http\Models\Entity\User;

  class Auth extends User {

    public function Authentication ($user , $passw)
    {
  		return User::json($this->findAll());
    }
  }

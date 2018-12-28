<?php

namespace Web\Http\Models\Entity;

use Doctrine\ORM\Annotation;
use Web\Http\Models\Entity\User;
use Doctrine\ORM\EntityManager;

/**
 * @Entity
 * @Table(name="auth")
 **/
class Auth extends EntityManager{
  /**
   * @Id
   * @var int
   * @Column(type="integer")
   * @GeneratedValue
   **/
  private $id;

  /**
   * @var string
   * @Column(type="string", unique=true)
   **/
  private $token;

  /**
   * @var string
   * @Column(type="string", unique=true)
   **/
  private $user;

  public function __construct(){}

  public function getId(): int
  {
    return $this->id;
  }

  public function getUser(): string
  {
    return $this->user;
  }

  public function getToken():string
  {
    return $this->token;
  }

  public function setToken($token): void {
    $this->token = $token;
  }

  public function setUser($user): void {
    $this->user = $user;
  }

  public function Authentication ($user , $passw)
    {
      $user = new User();
  		return User::json($user->findAll());
    }
  }

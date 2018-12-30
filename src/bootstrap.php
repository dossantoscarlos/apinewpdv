<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Psr7Middlewares\Middleware\TrailingSlash;
use Monolog\Logger;
use Firebase\JWT\JWT;

$isDevMode = true;
/**
 * Diretório de Entidades e Metadata do Doctrine
 */
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/web/Http/Models/Entity/"), $isDevMode);
/**
 * Array de configurações da nossa conexão com o banco
 */
$conn = array(
	'driver' => 'pdo_mysql',
	'host' => 'us-cdbr-iron-east-01.cleardb.net',
	'dbname' => 'heroku_5774f737433ca28',
	'user' => 'b043b94b560403',
	'password' => 'e2f7ad03',
);
/**
 * Instância do Entity Manager
 */
$entityManager = EntityManager::create($conn, $config);

return $entityManager;

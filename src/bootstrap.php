<?php 

/**
 * Container Resources do Slim.
 * Aqui dentro dele vamos carregar todas as dependências
 * da nossa aplicação que vão ser consumidas durante a execução
 * da nossa API
**/

// use Doctrine\Common\Annotations\AnnotationReader;
// use Doctrine\Common\Cache\FilesystemCache;
// use Doctrine\ORM\EntityManager;
// use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
// use Doctrine\ORM\Tools\Setup;


// $container[EntityManager::class] = function (Container $container): EntityManager {
//     $config = Setup::createAnnotationMetadataConfiguration(
//         $container['settings']['doctrine']['metadata_dirs'],
//         $container['settings']['doctrine']['dev_mode']
//     );

//     $config->setMetadataDriverImpl(
//         new AnnotationDriver(
//             new AnnotationReader,
//             $container['settings']['doctrine']['metadata_dirs']
//         )
//     );

//     $config->setMetadataCacheImpl(
//         new FilesystemCache(
//             $container['settings']['doctrine']['cache_dir']
//         )
//     );

//     return EntityManager::create(
//         $container['settings']['doctrine']['connection'],
//         $config
//     );
// };

// return $container;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Psr7Middlewares\Middleware\TrailingSlash;
use Monolog\Logger;
use Firebase\JWT\JWT;

$isDevMode = true;
/**
 * Diretório de Entidades e Metadata do Doctrine
 */
$config = Setup::createAnnotationMetadataConfiguration(array("app/Web/Http/Models/Entity/"), $isDevMode);
/**
 * Array de configurações da nossa conexão com o banco
 */
$conn = array(
	'driver' => 'pdo_mysql',
	'host' => 'us-cdbr-iron-east-01.cleardb.net',
	'dbname' => 'heroku_6dc08d68943683e',
	'user' => 'bae264541a2f71',
	'password' => '61aae678',
	
);
/**
 * Instância do Entity Manager
 */
$entityManager = EntityManager::create($conn, $config);

return $entityManager;
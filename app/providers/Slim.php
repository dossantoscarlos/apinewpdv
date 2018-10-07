<?php 
namespace App\Providers;

use Doctrine\ORM\EntityManager;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Slim\App;
/**
 * A ServiceProvider for registering services related
 * to Slim such as request handlers, routing and the
 * App service itself.
 */
class Slim implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function register(Container $cnt)
    {
        $cnt[PessoaRespository::class] = function (Container $cnt): PessoaRespository {
            return new PessoaRespository($cnt[EntityManager::class]);
        };
        
        $cnt[App::class] = function (Container $cnt): App {
            $app = new App($cnt);
            return $app;
        };
    }
}
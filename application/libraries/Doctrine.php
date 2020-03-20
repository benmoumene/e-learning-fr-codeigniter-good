<?php
use Doctrine\Common\ClassLoader, Doctrine\ORM\Configuration, Doctrine\ORM\EntityManager, Doctrine\Common\Cache\ArrayCache;

require './vendor/autoload.php';

class Doctrine
{

    public $em = null;

    public function __construct()
    {

        // Set up class loading. You could use different autoloaders, provided by your favorite framework,
        // if you want to.
        $connectionOptions = array(
            'driver' => 'pdo_mysql',
            'user' => 'root',
            'password' => '',
            'host' => 'localhost',
            'dbname' => 'test'
        );

        // Set up caches
        $config = new Configuration();
        $cache = new ArrayCache();
        $config->setMetadataCacheImpl($cache);
        $driverImpl = $config->newDefaultAnnotationDriver(array(
            APPPATH . 'models\entity'
        ));
        $config->setMetadataDriverImpl($driverImpl);
        $config->setQueryCacheImpl($cache);

        $config->setQueryCacheImpl($cache);

        // Proxy configuration
        $config->setProxyDir(APPPATH . 'models\proxies');
        $config->setProxyNamespace('Proxies');

        $config->setAutoGenerateProxyClasses(TRUE);

        // Create EntityManager
        $this->em = EntityManager::create($connectionOptions, $config);
    }
}
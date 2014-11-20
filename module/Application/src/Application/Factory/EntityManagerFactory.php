<?php

namespace Application\Factory;

use Doctrine\Common\Cache\ArrayCache;
use Doctrine\Common\Cache\ApcCache;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
//use DoctrineApp\EntityManagerWrapper;

/**
 * Description of EntityManagerFactory
 *
 * @author Akinyemi Odunlami <akinyemiodunlami@yahoo.co.uk>
 */
class EntityManagerFactory implements FactoryInterface {
    
    public function createService(ServiceLocatorInterface $serviceLocator) {
        
        $applicationMode = APPLICATION_ENV;
        
        if ($applicationMode == 'development') {
            $cache = new ArrayCache;
        } else {
            $cache = new ApcCache;
        }

        $config = new Configuration;
        
        $array = array(
            $serviceLocator->get('entity_paths')
        );
        
        $driverImpl = $config->newDefaultAnnotationDriver($array);
        
        $config->setMetadataDriverImpl($driverImpl);
        $config->setMetadataCacheImpl($cache);
        $config->setQueryCacheImpl($cache);
        $config->setResultCacheImpl($cache);
        $config->setProxyNamespace('Application\Proxies');

        if ($applicationMode == 'development') {
            $config->setAutoGenerateProxyClasses(true);
            $logger = $serviceLocator->get('EchoSQLLogger');
            $config->setSQLLogger($logger);
        } else {
            $config->setAutoGenerateProxyClasses(false);
        }

        if ($applicationMode == 'development') {
            $config->setProxyDir($serviceLocator->get('app_module_path') . DS . 'Proxies');
            $dbconfig = $serviceLocator->get('dbconfig_test');
        } else {
            $config->setProxyDir($serviceLocator->get('app_module_path') . DS . 'Proxies');            
            $dbconfig = $serviceLocator->get('dbconfig');
        }
        
        $entityManager = EntityManager::create($dbconfig, $config);
        return $entityManager;
        //$wrapper       = new EntityManagerWrapper($entityManager);
        //$wrapper->setEntityManger($entityManager);
        //return $wrapper;
        
    }
}

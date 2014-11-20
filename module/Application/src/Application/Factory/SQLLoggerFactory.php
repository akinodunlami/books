<?php

namespace Application\Factory;

use Application\EchoSQLLogger;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Description of SQLLoggerFactory
 *
 * @author Akinyemi Odunlami <akinyemiodunlami@yahoo.co.uk>
 */
class SQLLoggerFactory implements FactoryInterface {
    
    public function createService(ServiceLocatorInterface $serviceLocator) {
        $logger = new EchoSQLLogger($serviceLocator);
        return $logger;
    }

}

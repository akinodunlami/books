<?php

/**
 * Here we setup paths to application directories, and setup class loaders.
 * 
 * @author Akinyemi Odunlami <akinyemiodunlami@yahoo.co.uk>
 */

use Doctrine\Common\ClassLoader;
use Doctrine\Common\Cache\ArrayCache;
use Doctrine\Common\Cache\ApcCache;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;

defined('APPLICATION_ENV')  || define('APPLICATION_ENV', getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'development');
defined('DS')               || define('DS', DIRECTORY_SEPARATOR);

defined('BASE_PATH')        || define('BASE_PATH', __DIR__);

defined('LIB_PATH')         || define('LIB_PATH', BASE_PATH . DS . 'vendor');

defined('MOD_PATH')         || define('MOD_PATH', BASE_PATH . DS . 'module');

require 'vendor/autoload.php';

$doctrineLoader = new ClassLoader('Doctrine', LIB_PATH);
$doctrineLoader->register();

$zendLoader = new \Zend\Loader\StandardAutoloader(array(
    'namespaces' => array(
        'Books'     => MOD_PATH . DS . 'Books/src/Books',
        'UserMgr'   => MOD_PATH . DS . 'UserMgr/src/UserMgr',
    ),    
));

$zendLoader->register();

$applicationMode = /*'development'; //*/ APPLICATION_ENV;

if ($applicationMode == 'development') {
    $cache = new ArrayCache;
} else {
    $cache = new ApcCache;
}

$config = new Configuration;

$array = array(
    MOD_PATH . DS . 'Books/src/Books' . DS . 'Entities'
);

$driverImpl = $config->newDefaultAnnotationDriver($array);
$config->setMetadataDriverImpl($driverImpl);
$config->setMetadataCacheImpl($cache);
$config->setQueryCacheImpl($cache);
$config->setResultCacheImpl($cache);
$config->setProxyDir(MOD_PATH . DS . 'Application/src/Application' . DS . 'Proxies');
$config->setProxyNamespace('Application\Proxies');

if ($applicationMode == 'development') {
    $config->setAutoGenerateProxyClasses(true);
    //$logger = new \Doctrine\DBAL\Logging\EchoSQLLogger;
    //$config->setSQLLogger($logger);
} else {
    $config->setAutoGenerateProxyClasses(false);
}

if ($applicationMode == 'development') {
    $dbconfig = array(
        'driver'   => 'pdo_mysql',
        'user'     => 'books',
        'password' => 'books1234',
        'dbname'   => 'books',
    );
} else {
    //$dbconfig = $serviceLocator->get('dbconfig');
}

$em = EntityManager::create($dbconfig, $config);
        
$helpers = new Symfony\Component\Console\Helper\HelperSet(array(
    'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em)
));

\Doctrine\ORM\Tools\Console\ConsoleRunner::run($helpers);
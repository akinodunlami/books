<?php

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Console\Adapter\AdapterInterface as Console;
use Zend\ModuleManager\Feature\ConsoleBannerProviderInterface;
use Zend\ModuleManager\Feature\ConsoleUsageProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;

class Module implements ConsoleBannerProviderInterface, ConsoleUsageProviderInterface, ServiceProviderInterface
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function getConsoleBanner(Console $console ) {
        return 'SMS Platform 0.0.1';
    }
    
    /**
     * This method is defined in ConsoleUsageProviderInterface
     */
    public function getConsoleUsage(Console $console) {
        return array(
            'show stats'             => 'Show application statistics',
            'run cron'               => 'Run automated jobs',
            '(enable|disable) debug' => 'Enable or disable debug mode for the application.'
        );
    }
    
    public function getServiceConfig() {
        return array(
            'abstract_factories' => array(),
            'aliases'       => array(
                //'lookup'            => 'Lookup',
                //'DprEntityManager'  => 'EntityManager',
                //'entityDic'         => 'EntityDependencyContainer'
            ),
            'factories'     => array(
                'EntityManager'             => 'Application\Factory\EntityManagerFactory',
                'EchoSQLLogger'             => 'Application\Factory\SQLLoggerFactory',
                //'EntityDependencyContainer' => 'Application\Factory\EntityDependencyContainerFactory'
            ),
            'invokables'    => array(),
            'services'      => array(
                'sqlDebug'  => true,
                'dbconfig'  => array(
                    'driver'   => 'pdo_mysql',
                    'user'     => 'sms',
                    'password' => 'sms1234',
                    'dbname'   => 'sms',
                ),
                'dbconfig_remote'   => array(
                    'driver'    => 'pdo_mysql',
                    'user'      => 'root',
                    'password'  => '1234',
                    'dbname'    => 'dprremote',
                    'host'      => '31.222.161.117',
                    'port'      => '3306'
                ),
                'dbconfig_test' => array(
                    'driver'    => 'pdo_mysql',
                    'user'      => 'root',
                    'password'  => '1234',
                    'dbname'    => 'dprtest',
                ),
                'app_module_path'   => __DIR__ . '/src/' . __NAMESPACE__,
            ),
            'shared'        => array()       
        );
    }    
}

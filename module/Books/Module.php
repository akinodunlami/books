<?php

namespace Books;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Console\Adapter\AdapterInterface as Console;
use Zend\ModuleManager\Feature\ConsoleBannerProviderInterface;
use Zend\ModuleManager\Feature\ConsoleUsageProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\DependencyIndicatorInterface;

/**
 * Description of Module
 *
 * @author Akinyemi Odunlami <akinyemiodunlami@yahoo.co.uk>
 */
class Module implements 
    AutoloaderProviderInterface, 
    ConsoleBannerProviderInterface, 
    ConsoleUsageProviderInterface,         
    ConfigProviderInterface, 
    DependencyIndicatorInterface {
    
    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(__DIR__ . '/autoload_classmap.php',),               
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }
    
    public function getModuleDependencies() {
        return array('Application');
    }
    
    public function getConsoleBanner(Console $console ) {
        return 'Books Web Service 0.0.1';
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
}

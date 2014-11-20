<?php

namespace Application\Manager;

use Application\Manager\Exception;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventManager;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Description of AbstractManager
 *
 * @author Akinyemi Odunlami <akinyemiodunlami@yahoo.co.uk>
 */
abstract class AbstractManager implements ManagerInterface {

    protected $serviceLocator;
    protected $entityManager;
    protected $eventManager;
    protected $loggedInUser;

    public function __construct(ServiceLocatorInterface $serviceLocator = null, $loggedInUser = null) {
        $this->serviceLocator   = $serviceLocator;
        $this->loggedInUser     = $loggedInUser;
    }
    
    public function getServiceLocator() {
        return $this->serviceLocator;
    }

    public function setServiceLocator(ServiceLocatorInterface $serviceLocator) {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }

    public function getEntityManager() {
        if(!isset($this->entityManager)) {
            if(!$this->getServiceLocator()->has('EntityManager')) {
                throw new Exception\RuntimeException(
                        sprintf('%s was unable to fetch an instance of Doctrine Entity Manager...', 
                                __METHOD__));
            }
            $this->setEntityManager($this->getServiceLocator()->get('EntityManager'));
        }
        return $this->entityManager;
    }

    public function setEntityManager(EntityManagerInterface $entityManager = null) {
        $this->entityManager = $entityManager;
        return $this;
    }

    public function getEventManager() {
        if(!isset($this->eventManager)) {
            $this->setEventManager(new EventManager(array(__CLASS__, get_called_class())));
        }
        return $this->eventManager;
    }

    public function setEventManager(EventManagerInterface $eventManager) {
        $this->eventManager = $eventManager;
        return $this;
    }
    
    public function getLoggedInUser() {
        if(!isset($this->loggedInUser)) {
            if(!$this->getServiceLocator()->has('identity')) {
                throw new Exception('Unable to retrieve identity from service locator...');
            }
            $this->setIdentity($this->getServiceLocator()->get('identity'));
        }
        return $this->loggedInUser;
    }

    public function setLoggedInUser($loggedInUser) {
        $this->loggedInUser = $loggedInUser;
        return $this;
    }

}


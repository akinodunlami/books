<?php

namespace Application\Manager;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\EventManager\EventManagerAwareInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 *
 * @author Akinyemi Odunlami <akinyemiodunlami@yahoo.co.uk>
 */
interface ManagerInterface extends ServiceLocatorAwareInterface, EventManagerAwareInterface {
    
    public function getLoggedInUser();
    public function setLoggedInUser($loggedInUser);
    
    public function getEntityManager();
    public function setEntityManager(EntityManagerInterface $entityManager);
    
}


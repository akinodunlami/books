<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Math\Rand;
use Zend\Debug\Debug;

class IndexController extends AbstractActionController {

    public function indexAction() {
        //$entityManager = $this->getServiceLocator()->get('EntityManager');
        //\Doctrine\Common\Util\Debug::dump($entityManager);
        return new ViewModel();
    }

    public function resetPasswordAction() {
        $request = $this->getRequest();
        Debug::dump($request);
        $email = $request->getParam('userEmail');
        $pass = Rand::getString(16);
        return "it is working, Email: $email Password: $pass \n ";
    }

    public function defaultAction() {
        $request = $this->getRequest();
        Debug::dump($request);
    }
    
}

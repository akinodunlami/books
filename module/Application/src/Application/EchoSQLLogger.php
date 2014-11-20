<?php

namespace Application;

use Doctrine\DBAL\Logging\SQLLogger;
use Zend\Debug\Debug;

/**
 * Description of EchoSQLLogger
 *
 * @author Akinyemi Odunlami <akinyemiodunlami@yahoo.co.uk>
 */
class EchoSQLLogger implements SQLLogger {

    /**
     * {@inheritdoc}
     */
    public function startQuery($sql, array $params = null, array $types = null) {
        
        if($this->getServiceLocator()->has('sqlDebug')) {
            
            $dump   = $this->getServiceLocator()->has('sqlDump') ? 
                        $this->getServiceLocator()->get('sqlDump') : array();
            $dump[] = array('sql' => $sql, 'params' => $params, 'types' => $types); 
            
            $this->getServiceLocator()->setAllowOverride(true);
            $this->getServiceLocator()->setService('sqlDump', $dump);
            $this->getServiceLocator()->setAllowOverride(false);
            
        }else {
            
            Debug::dump($sql);

            if ($params) {
                Debug::dump($params);
            }

            if ($types) {
                Debug::dump($types);
            }
        }
    }
    
    /**
     * {@inheritdoc}
     */
    public function stopQuery() {}

}

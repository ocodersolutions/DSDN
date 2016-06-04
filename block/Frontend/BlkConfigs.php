<?php

namespace Block\Frontend;

use Zend\View\Helper\AbstractHelper;
use Zend\Session\Container;

class BlkConfigs extends AbstractHelper {

    protected $_data;

    public function __invoke() {
        require_once 'BlkCareers/default.phtml';
    }

    public function setData($configTable) {
        $ssSystem = new Container('system');
        
        $params['id'] = 1;
        $ssSystem->configs = $configTable->getItem($params); 
        
        //zprint
        echo "<pre>";
        var_dump($ssSystem->configs);
        echo "</pre>";
        die;
        
        return $this->_data;
    }

}

<?php

namespace Block\Admin;

use Zend\View\Helper\AbstractHelper;

class BlkLeftUserInfo extends AbstractHelper {

    protected $_data;

    public function __invoke() {
        require_once 'BlkLeftUserInfo/default.phtml';
    }

    public function setData($authService) {
        $this->_data = $authService->getStorage()->read();
        return $this->_data;
    }

}

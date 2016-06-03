<?php

namespace Block\Frontend;

use Zend\View\Helper\AbstractHelper;

class BlkPartners extends AbstractHelper {

    protected $_data;

    public function __invoke() {
        require_once 'BlkPartners/default.phtml';
    }

    public function setData($partnerTable) {
        $paginator = array(
            'itemCountPerPage' => 100,
            'pageRange' => PAGE_RANGE,
            'currentPageNumber' => 1,
        );
        $params['paginator'] = $paginator;
        $params['ssFilter']['order_by'] = 'id';
        $params['ssFilter']['order'] = 'desc';
        $this->_data = $partnerTable->listItem($params, array('task' => 'list-item'));
        $this->_data1 = $partnerTable->listItem($params, array('task' => 'list-item'));
        
        return $this->_data;
    }

}

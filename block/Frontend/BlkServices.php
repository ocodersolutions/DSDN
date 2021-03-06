<?php

namespace Block\Frontend;

use Zend\View\Helper\AbstractHelper;

class BlkServices extends AbstractHelper {

    protected $_data;

    public function __invoke() {
        require_once 'BlkServices/default.phtml';
    }

    public function setData($articleTable) {
        $paginator = array(
            'itemCountPerPage' => 200,
            'pageRange' => PAGE_RANGE,
            'currentPageNumber' => 1,
        );
        $params['paginator'] = $paginator;
        $params['ssFilter']['filter_category'] = SERVICE_CATEGORY_ID;
//        $params['ssFilter']['order_by'] = 'id';
//        $params['ssFilter']['order'] = 'desc';
        $this->_data = $articleTable->listItem($params, array('task' => 'list-item'));
        
        return $this->_data;
    }

}

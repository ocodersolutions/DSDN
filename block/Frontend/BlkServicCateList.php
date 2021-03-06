<?php

namespace Block\Frontend;

use Zend\View\Helper\AbstractHelper;

class BlkServicCateList extends AbstractHelper {

    protected $_data;

    public function __invoke() {
        require_once 'BlkServicCateList/default.phtml';
    }

    public function setData($aticlesTable) {
        $paginator = array(
            'itemCountPerPage' => 200,
            'pageRange' => PAGE_RANGE,
            'currentPageNumber' => 1,
        );
        $params['paginator'] = $paginator;
        $params['ssFilter']['filter_category'] = SERVICE_CATEGORY_ID;
//        $params['ssFilter']['order_by'] = 'id';
//        $params['ssFilter']['order'] = 'desc';
        $this->_data = $aticlesTable->listItem($params, array('task' => 'list-item'));
        
        return $this->_data;
    }
    //var_dump($this->_data);
}

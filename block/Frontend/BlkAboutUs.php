<?php

namespace Block\Frontend;

use Zend\View\Helper\AbstractHelper;

class BlkAboutUs extends AbstractHelper {

    protected $_data;

    public function __invoke() {
        require_once 'BlkAboutUs/default.phtml';
    }

    public function setData($aticlesTable) {
        $paginator = array(
            'itemCountPerPage' => 200,
            'pageRange' => PAGE_RANGE,
            'currentPageNumber' => 1,
        );
        $params['paginator'] = $paginator;
        $params['ssFilter']['filter_category'] = COMPANY_INFO_CATEGORY_ID;
//        $params['ssFilter']['order_by'] = 'id';
//        $params['ssFilter']['order'] = 'desc';
        $this->_data = $aticlesTable->listItem($params, array('task' => 'list-item'));
        
        return $this->_data;
    }
    //var_dump($this->_data);
}

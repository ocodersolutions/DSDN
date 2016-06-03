<?php

namespace Block\Frontend;

use Zend\View\Helper\AbstractHelper;

class BlkNewsCategory extends AbstractHelper {

    protected $_data;

    public function __invoke() {
        require_once 'BlkNewsCategory/default.phtml';
    }

    public function setData($categoryTable) {
        $paginator = array(
            'itemCountPerPage' => 200,
            'pageRange' => PAGE_RANGE,
            'currentPageNumber' => 1,
        );
        $params['paginator'] = $paginator;
        $params['ssFilter']['filter_parent'] = NEWS_CATEGORY_ID;
//        $params['ssFilter']['order_by'] = 'id';
//        $params['ssFilter']['order'] = 'desc';
        $this->_data = $categoryTable->listItem($params, array('task' => 'list-item'));
        
        return $this->_data;
    }

}

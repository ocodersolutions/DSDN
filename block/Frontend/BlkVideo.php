<?php

namespace Block\Frontend;

use Zend\View\Helper\AbstractHelper;

class BlkVideo extends AbstractHelper {

    protected $_data;

    public function __invoke() {
        require_once 'BlkVideo/default.phtml';
    }

    public function setData() {
//        $paginator = array(
//            'itemCountPerPage' => ROWS_PER_PAGE,
//            'pageRange' => PAGE_RANGE,
//            'currentPageNumber' => 1,
//        );
//        $params['paginator'] = $paginator;
//        $params['ssFilter']['filter_category_greater'] = NEWS_CATEGORY_ID;
//        $params['ssFilter']['order_by'] = 'id';
//        $params['ssFilter']['order'] = 'desc';
//        $this->_data = $articleTable->listItem($params, array('task' => 'list-item'));
//        
//        return $this->_data;
    }

}

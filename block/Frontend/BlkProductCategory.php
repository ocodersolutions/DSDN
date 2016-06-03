<?php

namespace Block\Frontend;

use Zend\View\Helper\AbstractHelper;

class BlkProductCategory extends AbstractHelper {

    protected $_data;

    public function __invoke() {
        require_once 'BlkProductCategory/default.phtml';
    }

    public function setData($productCategoryTable) {
        $paginator = array(
            'itemCountPerPage' => 200,
            'pageRange' => PAGE_RANGE,
            'currentPageNumber' => 1,
        );
        $params['paginator'] = $paginator;
        $params['ssFilter']['filter_parent'] = NEWS_CATEGORY_ID;
//        $params['ssFilter']['order_by'] = 'id';
//        $params['ssFilter']['order'] = 'desc';
        $this->_data = $productCategoryTable->listItem($params, array('task' => 'list-item'));
        
        return $this->_data;
    }

}

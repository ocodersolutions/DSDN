<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Ocoder\Base\BaseActionController as OcoderBaseController;
use Ocoder\Paginator\Paginator as OcoderPaginator;

class ProductController extends OcoderBaseController {

    public function init() {

        $this->_paginator['itemCountPerPage'] = 100;
    }

    public function indexAction() {
        //set Head info
        $this->_viewHelper->get('HeadTitle')->prepend(TITLE_PRODUCT . ' - ' . $this->_configs->title);
        $this->_viewHelper->get('HeadMeta')->setName('keywords', $this->_configs->keywords);
        $this->_viewHelper->get('HeadMeta')->setName('description', $this->_configs->description);
        
        $categoryTableGateway = $this->getServiceLocator()->get('Admin\Model\ProductCategoryTable');

        $this->_paginator['currentPageNumber'] = $this->params()->fromRoute('page', 1);
        $this->_params['paginator'] = $this->_paginator;

        $categories = $categoryTableGateway->listItem($this->_params, array('task' => 'list-item'));
        $categorySidebar = $categoryTableGateway->listItem($this->_params, array('task' => 'list-item'));

        return new ViewModel(array(
            'categories' => $categories,
            'categoriesSidebar' => $categoriesSidebar,
        ));
    }

    public function categoryAction(){
        $stringHelperOcoder = new \Ocoder\Helper\String();
        
        $aliasCategory = $this->params('alias-category');
        
        $categoryTableGateway = $this->getServiceLocator()->get('Admin\Model\ProductCategoryTable');
        $productTableGateway = $this->getServiceLocator()->get('Admin\Model\ProductTable');
        
        $this->_paginator['currentPageNumber'] = $this->params()->fromRoute('page', 1);
        $this->_params['paginator'] = $this->_paginator;

        $this->_params['ssFilter']['filter_keyword_type'] = array('alias', 'alias_lang');
        $this->_params['ssFilter']['filter_keyword_value'] = $aliasCategory;
        $categories = $categoryTableGateway->listItem($this->_params, array('task' => 'list-item'));
        
        foreach ($categories as $category) {
            $categoryInfo = $category;
            break;
        }
        
        //set Head meta
        $ssSystem = new Container('system');
        if ($ssSystem->language == DEFAULT_LANGUAGE) {
            $name = $categoryInfo->name . ', ' . str_replace("-", " ", $stringHelperOcoder->convertStringToAlias($categoryInfo->name));
            $keyword = trim($categoryInfo->keyword) ? $categoryInfo->keyword : $this->_configs->keywords;
            $description = trim($categoryInfo->description) ? $categoryInfo->description : $this->_configs->description;
        } else {
            $nameLang = json_decode($categoryInfo->name_lang);
            $nameField = 'name_' . $ssSystem->language;
            $name = $nameLang->$nameField;
            $keywordLang = json_decode($categoryInfo->keyword_lang);
            $keywordField = 'keyword_' . $ssSystem->language;
            $keyword = trim($keywordLang->$keywordField) ? $keywordLang->$keywordField : $this->_configs->keywords;
            $descriptionLang = json_decode($categoryInfo->description_lang);
            $descriptionField = 'description_' . $ssSystem->language;
            $description = trim($descriptionLang->$descriptionField) ? $descriptionLang->$descriptionField : $this->_configs->description;
        }
        $this->_viewHelper->get('HeadTitle')->prepend($name . ' - ' . $this->_configs->title);
        $this->_viewHelper->get('HeadMeta')->setName('keywords', $keyword);
        $this->_viewHelper->get('HeadMeta')->setName('description', $description);
        
        unset($this->_params['ssFilter']);
        $this->_params['ssFilter']['filter_category'] = $categoryInfo->id;
        $this->_params['ssFilter']['order_by'] = 'id';
        $this->_params['ssFilter']['order'] = 'DESC';
        $products = $productTableGateway->listItem($this->_params, array('task' => 'list-item'));
        
        return new ViewModel(array(
            'categoryInfo' => $categoryInfo,
            'products' => $products,
        ));
    }

    public function productAction(){
        $stringHelperOcoder = new \Ocoder\Helper\String();

        $aliasProduct = $this->params('alias');
        
        $this->_paginator['currentPageNumber'] = $this->params()->fromRoute('page', 1);
        $this->_params['paginator'] = $this->_paginator;

        $this->_params['ssFilter']['filter_keyword_type'] = array('alias', 'alias_lang');
        $this->_params['ssFilter']['filter_keyword_value'] = $aliasProduct;
        
        $productTableGateway = $this->getServiceLocator()->get('Admin\Model\ProductTable');
        $products = $productTableGateway->listItem($this->_params, array('task' => 'list-item'));
        
        foreach ($products as $product) {
            $productInfo = $product;
            break;
        }
        
        //set Head meta
        $ssSystem = new Container('system');
        if ($ssSystem->language == DEFAULT_LANGUAGE) {
            $name = $productInfo->name . ', ' . str_replace("-", " ", $stringHelperOcoder->convertStringToAlias($productInfo->name));
            $keyword = trim($productInfo->keyword) ? $productInfo->keyword : $this->_configs->keywords;
            $description = trim($productInfo->description) ? $productInfo->description : $this->_configs->description;
        } else {
            $nameLang = json_decode($productInfo->name_lang);
            $nameField = 'name_' . $ssSystem->language;
            $name = $nameLang->$nameField;
            $keywordLang = json_decode($productInfo->keyword_lang);
            $keywordField = 'keyword_' . $ssSystem->language;
            $keyword = trim($keywordLang->$keywordField) ? $keywordLang->$keywordField : $this->_configs->keywords;
            $descriptionLang = json_decode($productInfo->description_lang);
            $descriptionField = 'description_' . $ssSystem->language;
            $description = trim($descriptionLang->$descriptionField) ? $descriptionLang->$descriptionField : $this->_configs->description;
        }
        $this->_viewHelper->get('HeadTitle')->prepend($name . ' - ' . $this->_configs->title);
        $this->_viewHelper->get('HeadMeta')->setName('keywords', $keyword);
        $this->_viewHelper->get('HeadMeta')->setName('description', $description);
        
        return new ViewModel(array(
            'productInfo' => $productInfo,
        ));
    }
}

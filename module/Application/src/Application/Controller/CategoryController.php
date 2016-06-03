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
use Ocoder\Base\BaseActionController as OcoderBaseController;
use Ocoder\Paginator\Paginator as OcoderPaginator;
use Zend\Session\Container;

class CategoryController extends OcoderBaseController {

    public function init() {
        $this->_paginator['itemCountPerPage'] = 100;
    }

    public function indexAction() {
        //set Head info
        $this->_viewHelper->get('HeadTitle')->prepend(TITLE_NEWS . ' - ' . $this->_configs->title);
        $this->_viewHelper->get('HeadMeta')->setName('keywords', $this->_configs->keywords);
        $this->_viewHelper->get('HeadMeta')->setName('description', $this->_configs->description);
        
        $categoryTableGateway = $this->getServiceLocator()->get('Admin\Model\CategoryTable');
        $articleTableGateway = $this->getServiceLocator()->get('Admin\Model\ArticleTable');

        $this->_paginator['currentPageNumber'] = $this->params()->fromRoute('page', 1);
        $this->_params['paginator'] = $this->_paginator;

        $this->_params['ssFilter']['filter_parent'] = NEWS_CATEGORY_ID;
        $categoryNews = $categoryTableGateway->listItem($this->_params, array('task' => 'list-item'));
        $categoryNewsSidebar = $categoryTableGateway->listItem($this->_params, array('task' => 'list-item'));
        
        $categoryList = array();
        foreach ($categoryNews as $category) {
            $this->_paginator['currentPageNumber'] = $this->params()->fromRoute('page', 1);
            $this->_paginator['itemCountPerPage'] = 5; 
            $this->_params['paginator'] = $this->_paginator;
            $this->_params['ssFilter']['filter_category'] = $category->id;
            $this->_params['ssFilter']['order_by'] = 'id';
            $this->_params['ssFilter']['order'] = 'DESC';
            $articles = $articleTableGateway->listItem($this->_params, array('task' => 'list-item'));
            
            $category->articles = $articles;
            $categoryList[] = $category;
        }

        return new ViewModel(array(
            'categoryNews' => $categoryList,
            'categoryNewsSidebar' => $categoryNewsSidebar,
        ));
    }

    public function detailAction() {   
        $stringHelperOcoder = new \Ocoder\Helper\String();
             
        $categoryId = $this->params('id');
        $articleTableGateway = $this->getServiceLocator()->get('Admin\Model\ArticleTable');
        $categoryTableGateway = $this->getServiceLocator()->get('Admin\Model\CategoryTable');

        $this->_paginator['currentPageNumber'] = $this->params()->fromRoute('page', 1);
//        $this->_paginator['itemCountPerPage'] = 1;
        $this->_params['paginator'] = $this->_paginator;

        $this->_params['ssFilter']['filter_category'] = $categoryId;
        $countArticles = $articleTableGateway->countItem($this->_params, array('task' => 'list-item'));
        $articles = $articleTableGateway->listItem($this->_params, array('task' => 'list-item'));

        unset($this->_params['ssFilter']);
        $this->_params['ssFilter']['filter_parent'] = NEWS_CATEGORY_ID;
        $categoryNews = $categoryTableGateway->listItem($this->_params, array('task' => 'list-item'));
        $categoryInfo = $categoryTableGateway->getItem(array('id' => $categoryId));

        //set Head info
        $this->_viewHelper->get('HeadTitle')->prepend($categoryInfo->name . ', ' . $stringHelperOcoder->convertStringToAlias($categoryInfo->name) . ' - ' . $this->_configs->title);
        $this->_viewHelper->get('HeadMeta')->setName('keywords', $this->_configs->keywords);
        $this->_viewHelper->get('HeadMeta')->setName('description', $this->_configs->description);

        return new ViewModel(array(
            'categoryInfo' => $categoryInfo,
            'articles' => $articles,
            'paginator' => OcoderPaginator::createPaginator($countArticles, $this->_params['paginator']),
        ));
    }

    public function detailChildAction() {
        $stringHelperOcoder = new \Ocoder\Helper\String();
        
        $aliasCategory = $this->params('alias-cateogry');

        $articleTableGateway = $this->getServiceLocator()->get('Admin\Model\ArticleTable');
        $categoryTableGateway = $this->getServiceLocator()->get('Admin\Model\CategoryTable');

        unset($this->_params['ssFilter']);
        $this->_paginator['currentPageNumber'] = 1;
        $this->_params['paginator'] = $this->_paginator;

        $this->_params['ssFilter']['filter_keyword_type'] = array('alias', 'alias_lang');
        $this->_params['ssFilter']['filter_keyword_value'] = $aliasCategory;
        $categoryParents = $categoryTableGateway->listItem($this->_params, array('task' => 'list-item'));

        foreach ($categoryParents as $category) {
            $categoryId = $category->id;
            $categoryInfo = $category;
        }

        unset($this->_params['ssFilter']);
        $this->_paginator['currentPageNumber'] = $this->params('page', 1);
        $this->_params['paginator'] = $this->_paginator;
        $this->_params['ssFilter']['order_by'] = 'id';
        $this->_params['ssFilter']['order'] = 'DESC';
        $this->_params['ssFilter']['filter_category'] = $categoryId;
        $countArticles = $articleTableGateway->countItem($this->_params, array('task' => 'list-item'));

        $articles = $articleTableGateway->listItem($this->_params, array('task' => 'list-item'));

        unset($this->_params['ssFilter']);
        $this->_params['ssFilter']['filter_parent'] = NEWS_CATEGORY_ID;
        $categoryNews = $categoryTableGateway->listItem($this->_params, array('task' => 'list-item'));
        
        //set Head info
        $this->_viewHelper->get('HeadTitle')->prepend($categoryInfo->name . ', ' . $stringHelperOcoder->convertStringToAlias($categoryInfo->name) . ' - ' . $this->_configs->title);
        $this->_viewHelper->get('HeadMeta')->setName('keywords', $this->_configs->keywords);
        $this->_viewHelper->get('HeadMeta')->setName('description', $this->_configs->description);

        return new ViewModel(array(
            'categoryInfo' => $categoryInfo,
            'articles' => $articles,
            'categoryNews' => $categoryNews,
            'paginator' => OcoderPaginator::createPaginator($countArticles, $this->_params['paginator']),
        ));
    }

    public function articleAction() {
        $stringHelperOcoder = new \Ocoder\Helper\String();
        $aliasArticle = $this->params('alias');
        
        $articleTableGateway = $this->getServiceLocator()->get('Admin\Model\ArticleTable');
        $categoryTableGateway = $this->getServiceLocator()->get('Admin\Model\CategoryTable');

        $this->_paginator['currentPageNumber'] = $this->params()->fromRoute('page', 1);
        $this->_params['paginator'] = $this->_paginator;

        $this->_params['ssFilter']['filter_keyword_type'] = array('alias', 'alias_lang');
        $this->_params['ssFilter']['filter_keyword_value'] = $aliasArticle;
        $articles = $articleTableGateway->listItem($this->_params, array('task' => 'list-item'));
        foreach ($articles as $article) {
            $item = $article;
            break;
        }
        
        unset($this->_params['ssFilter']);
        $this->_params['ssFilter']['filter_parent'] = NEWS_CATEGORY_ID;
        $categoryNews = $categoryTableGateway->listItem($this->_params, array('task' => 'list-item'));
        
        unset($this->_params['ssFilter']);
        $this->_params['paginator']['itemCountPerPage'] = 3;
        $this->_params['ssFilter']['filter_category_greater'] = NEWS_CATEGORY_ID;
        $this->_params['ssFilter']['order_by'] = 'id';
        $this->_params['ssFilter']['order'] = 'desc';
        $news = $articleTableGateway->listItem($this->_params, array('task' => 'list-item'));
        
        //set Head meta
        $ssSystem = new Container('system');        
        if ($ssSystem->language == DEFAULT_LANGUAGE) {
            $name = $item->name . ', ' . str_replace("-", " ", $stringHelperOcoder->convertStringToAlias($item->name));
            $keyword = trim($item->keyword) ? $item->keyword : $this->_configs->keywords;
            $intro = trim($item->intro) ? $item->intro : $this->_configs->description;
        } else {
            $nameLang = json_decode($item->name_lang);
            $nameField = 'name_' . $ssSystem->language;
            $name = $nameLang->$nameField;
            $keywordLang = json_decode($item->keyword_lang);
            $keywordField = 'keyword_' . $ssSystem->language;
            $keyword = trim($keywordLang->$keywordField) ? $keywordLang->$keywordField : $this->_configs->keywords;
            $introLang = json_decode($item->intro_lang);
            $introField = 'intro_' . $ssSystem->language;
            $intro = trim($introLang->$introField) ? $introLang->$introField : $this->_configs->description;
        }
        $this->_viewHelper->get('HeadTitle')->prepend($name . ' - ' . $this->_configs->title);
        $this->_viewHelper->get('HeadMeta')->setName('keywords', $keyword);
        $this->_viewHelper->get('HeadMeta')->setName('description', $intro);
        
        return new ViewModel(array(
            'item' => $item,
            'categoryNews' => $categoryNews,
            'news' => $news,
        ));
    }
}

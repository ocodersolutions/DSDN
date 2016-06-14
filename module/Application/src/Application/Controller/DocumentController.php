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

class DocumentController extends OcoderBaseController
{
    public function init() {
        // Check login
        $this->getAuthService();
        if (!$this->_authService->hasIdentity() && $this->_params['action'] != 'login') {
            $this->goAction('application', array('controller' => 'account', 'action' => 'login'));
        }
    }
    
    //Get all Documents
    public function indexAction()
    {
    	$stringHelperOcoder = new \Ocoder\Helper\String();

        $documentTableGateway = $this->getServiceLocator()->get('Admin\Model\DocumentTable');

        unset($this->_params['ssFilter']);
        $this->_paginator['currentPageNumber'] = 1;
        $this->_paginator['itemCountPerPage'] = 3000;
        $this->_params['paginator'] = $this->_paginator;

        // $this->_params['ssFilter']['filter_keyword_type'] = array('alias', 'alias_lang');
        // $this->_params['ssFilter']['filter_keyword_value'] = $aliasCategory;
        $documents = $documentTableGateway->listItem($this->_params, array('task' => 'list-item'));

        

        // unset($this->_params['ssFilter']);
        // $this->_paginator['currentPageNumber'] = $this->params('page', 1);
        // $this->_params['paginator'] = $this->_paginator;
        // $this->_params['ssFilter']['order_by'] = 'id';
        // $this->_params['ssFilter']['order'] = 'DESC';
        // $this->_params['ssFilter']['filter_category'] = $categoryId;
        // $countArticles = $articleTableGateway->countItem($this->_params, array('task' => 'list-item'));

        // $articles = $articleTableGateway->listItem($this->_params, array('task' => 'list-item'));

        // unset($this->_params['ssFilter']);
        // $this->_params['ssFilter']['filter_parent'] = NEWS_CATEGORY_ID;
        // $categoryNews = $categoryTableGateway->listItem($this->_params, array('task' => 'list-item'));
        
        // //set Head info
        // $this->_viewHelper->get('HeadTitle')->prepend($categoryInfo->name . ', ' . $stringHelperOcoder->convertStringToAlias($categoryInfo->name) . ' - ' . $this->_configs->title);
        // $this->_viewHelper->get('HeadMeta')->setName('keywords', $this->_configs->keywords);
        // $this->_viewHelper->get('HeadMeta')->setName('description', $this->_configs->description);

        return new ViewModel(array(
            // 'categoryInfo' => $categoryInfo,
            'documents' => $documents,
            // 'categoryNews' => $categoryNews,
            // 'paginator' => OcoderPaginator::createPaginator($countArticles, $this->_params['paginator']),
        ));
    }
}
    
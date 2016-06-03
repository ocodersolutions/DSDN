<?php

namespace Admin\Controller;

use Zend\Form\FormInterface;
use Zend\Session\Container;
use Zend\View\Model\ViewModel;
use Ocoder\Paginator\Paginator as OcoderPaginator;
use Ocoder\Base\BaseActionController as OcoderBaseController;

class CategoryController extends OcoderBaseController {

    public function init() {
        // OPTIONS
        $this->_options['tableName'] = TABLE_ARTICLES;
        $this->_options['modelTable'] = 'Admin\Model\ArticleTable';
        $this->_options['formName'] = 'formAdminCategory';
        // DATA
        $this->_params['data'] = $this->getRequest()->getPost()->toArray();
        
        $this->_params['ssFilter']['order_by'] = 'id';
        $this->_params['ssFilter']['order'] = 'DESC';
        
        // Check login
        $this->getAuthService();
        if (!$this->_authService->hasIdentity()) {
            $this->goAction('admin', array('controller' => 'account', 'action' => 'login'));
        }
    }
    
    public function childAction(){
        $categoryTableGateway = $this->getServiceLocator()->get('Admin\Model\CategoryTable');
        
        $parentId = $this->params('id');
        
        $this->_paginator['currentPageNumber'] = $this->params()->fromRoute('page', 1);
        $this->_params['paginator'] = $this->_paginator;
        
        if($parentId){
            $this->_params['ssFilter']['filter_parent'] = $parentId;
        }
       
        $categories = $categoryTableGateway->listItem($this->_params, array('task' => 'list-item'));
        $total = $categoryTableGateway->countItem($this->_params, array('task' => 'list-item'));
        
        return new ViewModel(array(
            'categories' => $categories,
            'paginator' => OcoderPaginator::createPaginator($total, $this->_params['paginator']),
        ));
    }
    
    public function formAction() {
        $helperString = new \Ocoder\Helper\String;
        $categoryTableGateway = $this->getServiceLocator()->get('Admin\Model\CategoryTable');
        
        $myForm = $this->getForm();
        $task = 'add-item';
        $this->_params['data']['id'] = $this->params('id');

        if (!empty($this->_params['data']['id'])) {
            $item = $categoryTableGateway->getItem($this->_params['data']);

            if (!empty($item)) {

                $nameLang = json_decode($item->name_lang);
                $item->name_en = $nameLang->name_en;
                $item->name_jp = $nameLang->name_jp;
                $introLang = json_decode($item->intro_lang);
                $item->intro_en = $introLang->intro_en;
                $item->intro_jp = $introLang->intro_jp;
                $keywordLang = json_decode($item->keyword_lang);
                $item->keyword_en = $keywordLang->keyword_en;
                $item->keyword_jp = $keywordLang->keyword_jp;

                
                $myForm->bind($item);
                $task = 'edit-item';
            }
        }
        if ($this->getRequest()->isPost()) {
            $action = $this->_params['data']['action'];
//            $myForm->setData($this->_params['data']);
//            if ($myForm->isValid()) {
//                $this->_params['data'] = $myForm->getData(FormInterface::VALUES_AS_ARRAY);
            $nameEn = trim($this->_params['data']['name_en']) ? $this->_params['data']['name_en'] : $this->_params['data']['name'];
            $nameJp = trim($this->_params['data']['name_jp']) ? $this->_params['data']['name_jp'] : $this->_params['data']['name'];
            $this->_params['data']['name_lang'] = json_encode(
                    array(
                        'name_en' => $nameEn,
                        'name_jp' => $nameJp,
            ));
            unset($this->_params['data']['name_en']);
            unset($this->_params['data']['name_jp']);
            
            $this->_params['data']['alias'] = $helperString->convertStringToAlias($this->_params['data']['name']);
            $this->_params['data']['alias_lang'] = json_encode(
                    array(
                        'alias_en' => $helperString->convertStringToAlias($nameEn),
                        'alias_jp' => $helperString->convertStringToAlias($nameEn),
                    )
            );

            $this->_params['data']['intro_lang'] = json_encode(
                    array(
                        'intro_en' => trim($this->_params['data']['intro_en']) ? $this->_params['data']['intro_en'] : $this->_params['data']['intro'],
                        'intro_jp' => trim($this->_params['data']['intro_jp']) ? $this->_params['data']['intro_jp'] : $this->_params['data']['intro'],
            ));
            unset($this->_params['data']['intro_en']);
            unset($this->_params['data']['intro_jp']);

            $this->_params['data']['keyword_lang'] = json_encode(
                    array(
                        'keyword_en' => trim($this->_params['data']['keyword_en']) ? $this->_params['data']['keyword_en'] : $this->_params['data']['keyword'],
                        'keyword_jp' => trim($this->_params['data']['keyword_jp']) ? $this->_params['data']['keyword_jp'] : $this->_params['data']['keyword'],
            ));
            unset($this->_params['data']['keyword_en']);
            unset($this->_params['data']['keyword_jp']);

            $this->_params['data']['status'] = ($this->_params['data']['status'] == 'active') ? 1 : 0;
            unset($this->_params['data']['action']);

            $id = $categoryTableGateway->saveItem($this->_params['data'], array('task' => $task));
            $this->flashMessenger()->addMessage('Dữ liệu đã được lưu thành công!');
            if ($action == 'save-close')
//                $this->goAction('admin', array('controller' => 'article'));
            if ($action == 'save-new')
                $this->goAction('admin', array('controller' => 'category', 'action' => 'form'));
            if ($action == 'save')
                $this->goAction('admin', array('controller' => 'category', 'action' => 'form', 'id' => $id));
//            }
        }

        return new ViewModel(array(
            'myForm' => $myForm,
        ));
    }
    
    public function detailAction(){
        $categoryTableGateway = $this->getServiceLocator()->get('Admin\Model\CategoryTable');
        $categoryId = $this->params('id');
        $category = $categoryTableGateway->getItem(array('id' => $categoryId));
        
        $this->_paginator['currentPageNumber'] = $this->params()->fromRoute('page', 1);
        $this->_params['paginator'] = $this->_paginator;
        
        $this->_params['ssFilter']['filter_category'] = $categoryId;
        
        $total = $this->getTable()->countItem($this->_params, array('task' => 'list-item'));
        $items = $this->getTable()->listItem($this->_params, array('task' => 'list-item'));
        
        return new ViewModel(array(
            'items' => $items,
            'paginator' => OcoderPaginator::createPaginator($total, $this->_params['paginator']),
            'category' => $category,
        ));
        
    }
    
    public function deleteAction() {
        $categoryTableGateway = $this->getServiceLocator()->get('Admin\Model\CategoryTable');
        if ($this->getRequest()->isPost()) {
            $item = $this->getTable()->getItem(array('id' => $this->_params['data']['cid'][0]));
            $categoryId = $item->category_id;
           
            $flagAction = $this->getTable()->deleteItem($this->_params['data'], array('task' => 'multi-delete'));
            if ($flagAction == true) {
                $this->flashMessenger()->addMessage(DELETE_SUCCESS);
            } else {
                $this->flashMessenger()->addMessage(HAVE_ERROR);
            }
        }

        $this->goAction('admin', array('action' => 'detail', 'id' => $categoryId));
    }
    
    public function deleteCustomAction() {
        $categoryTableGateway = $this->getServiceLocator()->get('Admin\Model\CategoryTable');
        if ($this->getRequest()->isPost()) {
            $flagAction = $categoryTableGateway->deleteItem($this->_params['data'], array('task' => 'multi-delete'));
            if ($flagAction == true) {
                $this->flashMessenger()->addMessage(DELETE_SUCCESS);
            } else {
                $this->flashMessenger()->addMessage(HAVE_ERROR);
            }
        }

        $this->goAction('admin', array('action' => 'index', 'id' => NEWS_CATEGORY_ID));
    }

}

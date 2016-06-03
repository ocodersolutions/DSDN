<?php
namespace Admin\Controller;

use Zend\Form\FormInterface;
use Zend\Session\Container;
use Zend\View\Model\ViewModel;
use Ocoder\Paginator\Paginator as OcoderPaginator;
use Ocoder\Base\BaseActionController as OcoderActionController;

class BannerController extends OcoderActionController
{
    public function init()
    {
        // OPTIONS
        $this->_options['modelTable'] = 'Admin\Model\BannerTable';
        $this->_options['formName'] = 'formAdminBanner';
    
        // DATA
        $this->_params['data'] = array_merge(
            $this->getRequest()->getPost()->toArray(), $this->getRequest()->getFiles()->toArray()
        );
    }
    public function indexAction()
    {
        
        // SESSION FILTER
        $ssFilter = new Container(__CLASS__);

        $this->_params['ssFilter']['order_by'] = !empty($ssFilter->order_by) ? $ssFilter->order_by : 'id';
        $this->_params['ssFilter']['order'] = !empty($ssFilter->order) ? $ssFilter->order : 'DESC';
        $this->_params['ssFilter']['filter_status'] = $ssFilter->filter_status;
        $this->_params['ssFilter']['filter_special'] = $ssFilter->filter_special;
        $this->_params['ssFilter']['filter_category'] = $ssFilter->filter_category;
        $this->_params['ssFilter']['filter_keyword_type'] = array('name', 'id');
        $this->_params['ssFilter']['filter_keyword_value'] = $ssFilter->filter_keyword_value;
        // PAGINATOR
        $this->_paginator['currentPageNumber'] = $this->params()->fromRoute('page', 1);
        $this->_params['paginator'] = $this->_paginator;

        $total = $this->getTable()->countItem($this->_params, array('task' => 'list-item'));
        $items = $this->getTable()->listItem($this->_params, array('task' => 'list-item'));
        return new ViewModel(array(
            'items' => $items,
            'paginator' => OcoderPaginator::createPaginator($total, $this->_params['paginator']),
            'ssFilter' => $this->_params['ssFilter'],
        ));
            
    }
    public function filterAction() 
    {
        if ($this->getRequest()->isPost()) {
            $ssFilter = new Container(__CLASS__);
            $data = $this->_params['data'];
            $ssFilter->order_by = $data['order_by'];
            $ssFilter->order = $data['order'];
            $ssFilter->filter_group = $data['filter_group'];
            $ssFilter->filter_keyword_type = $data['filter_keyword_type'];
            $ssFilter->filter_keyword_value = $data['filter_keyword_value'];
            $btnClear = $data['btn-clear'];
    
            if ($btnClear == 'btn-clear') {
                $ssFilter->offsetUnset('filter_keyword_type');
                $ssFilter->offsetUnset('filter_keyword_value');
            }
        }
        $this->goAction('admin', array('controller' => 'banner', 'action' => 'index'));
    }
    public function deleteAction() 
    {
        if ($this->getRequest()->isPost()) {
            $flagAction = $this->getTable()->deleteItem($this->_params['data'], array('task' => 'multi-delete'));
            if ($flagAction == true) {
                $this->flashMessenger()->addSuccessMessage(DELETE_SUCCESS);
            } else {
                $this->flashMessenger()->addErrorMessage(HAVE_ERROR);
            }
        }
    
        $this->goAction('admin', array('action' => 'index'));
    }
    
    public function formAction() 
    {
        $myForm = $this->getForm();
        $task = 'add-item';
        $this->_params['data']['id'] = $this->params('id');
    
        if (!empty($this->_params['data']['id'])) {
            $item = $this->getTable()->getItem($this->_params['data']);
    
            if (!empty($item)) {
                $nameLang = json_decode($item->name_lang);
                $item->name_en = $nameLang->name_en;
                $item->name_jp = $nameLang->name_jp;
                $descriptionLang = json_decode($item->description_lang);
                $item->description_en = $descriptionLang->description_en;
                $item->description_jp = $descriptionLang->description_jp; 
                $myForm->bind($item);
                $task = 'edit-item';
            }
        }
        if ($this->getRequest()->isPost()) {
    
            $action = $this->_params['data']['action'];
            //            $myForm->setData($this->_params['data']);
            //            if ($myForm->isValid()) {
            //                $this->_params['data'] = $myForm->getData(FormInterface::VALUES_AS_ARRAY);
            $this->_params['data']['name_lang'] = json_encode(
                array(
                    'name_en' => $this->_params['data']['name_en'] ? $this->_params['data']['name_en'] : $this->_params['data']['name'],
                    'name_jp' => $this->_params['data']['name_jp'] ? $this->_params['data']['name_jp'] : $this->_params['data']['name'],
                ));
            unset($this->_params['data']['name_en']);
            unset($this->_params['data']['name_jp']);
    
    
            $this->_params['data']['description_lang'] = json_encode(
                array(
                    'description_en' => $this->_params['data']['description_en'] ? $this->_params['data']['description_en'] : $this->_params['data']['description'],
                    'description_jp' => $this->_params['data']['description_jp'] ? $this->_params['data']['description_jp'] : $this->_params['data']['description'],
                ));
            unset($this->_params['data']['description_en']);
            unset($this->_params['data']['description_jp']);
    
  
            $id = $this->getTable()->saveItem($this->_params['data'], array('task' => $task));
            $this->flashMessenger()->addMessage('Dữ liệu đã được lưu thành công!');
            if ($action == 'save-close')
                $this->goAction('admin', array('controller' => 'banner'));
            if ($action == 'save-new')
                $this->goAction('admin', array('controller' => 'banner', 'action' => 'form'));
            if ($action == 'save')
                $this->goAction('admin', array('controller' => 'banner', 'action' => 'form', 'id' => $id));
            //            }
        }
    
        return new ViewModel(array(
            'myForm' => $myForm,
        ));
    } 
}
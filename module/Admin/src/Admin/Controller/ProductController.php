<?php

namespace Admin\Controller;

use Zend\Form\FormInterface;
use Zend\Session\Container;
use Zend\View\Model\ViewModel;
use Ocoder\Paginator\Paginator as OcoderPaginator;
use Ocoder\Base\BaseActionController as OcoderActionController;

class ProductController extends OcoderActionController {

    public function init() {
        // OPTIONS
        $this->_options['modelTable'] = 'Admin\Model\ProductTable';
        $this->_options['formName'] = 'formAdminProduct';

        // DATA
        $this->_params['data'] = array_merge(
                $this->getRequest()->getPost()->toArray(), $this->getRequest()->getFiles()->toArray()
        );
    }

    public function indexAction() {
        // SESSION FILTER
        $ssFilter = new Container(__CLASS__);

        $this->_params['ssFilter']['order_by'] = !empty($ssFilter->order_by) ? $ssFilter->order_by : 'id';
        $this->_params['ssFilter']['order'] = !empty($ssFilter->order) ? $ssFilter->order : 'DESC';
        $this->_params['ssFilter']['filter_status'] = $ssFilter->filter_status;
        $this->_params['ssFilter']['filter_special'] = $ssFilter->filter_special;
        $this->_params['ssFilter']['filter_category'] = $ssFilter->filter_category;
        $this->_params['ssFilter']['filter_keyword_type'] = $ssFilter->filter_keyword_type;
        $this->_params['ssFilter']['filter_keyword_value'] = $ssFilter->filter_keyword_value;

        // PAGINATOR
        $this->_paginator['currentPageNumber'] = $this->params()->fromRoute('page', 1);
        $this->_params['paginator'] = $this->_paginator;

        $total = $this->getTable()->countItem($this->_params, array('task' => 'list-item'));
        $items = $this->getTable()->listItem($this->_params, array('task' => 'list-item'));
        $slbCategory = $this->getServiceLocator()->get('Admin\Model\ProductCategoryTable')->itemInSelectbox(null, array('task' => 'list-product'));
        return new ViewModel(array(
            'items' => $items,
            'paginator' => OcoderPaginator::createPaginator($total, $this->_params['paginator']),
            'ssFilter' => $this->_params['ssFilter'],
            'slbCategory' => $slbCategory,
        ));
    }

    public function filterAction() {
        if ($this->getRequest()->isPost()) {
            $ssFilter = new Container(__CLASS__);
            $data = $this->_params['data'];
            $ssFilter->order_by = $data['order_by'];
            $ssFilter->order = $data['order'];
            $ssFilter->filter_status = $data['filter_status'];
            $ssFilter->filter_special = $data['filter_special'];
            $ssFilter->filter_category = $data['filter_category'];
            $ssFilter->filter_keyword_type = $data['filter_keyword_type'];
            $ssFilter->filter_keyword_value = $data['filter_keyword_value'];

            $btnClear = $data['btn-clear'];

            if ($btnClear == 'btn-clear') {
                $ssFilter->offsetUnset('filter_keyword_type');
                $ssFilter->offsetUnset('filter_keyword_value');
            }
        }
        $this->goAction();
    }

    public function statusAction() {
        if ($this->getRequest()->isPost()) {
            $flagAction = $this->getTable()->changeStatus($this->_params['data'], array('task' => 'change-status'));
            if ($flagAction == true)
                $this->flashMessenger()->addMessage('Trạng thái của phần tử đã được cập nhật thành công!');
        }
        $this->goAction();
    }

    public function specialAction() {
        if ($this->getRequest()->isPost()) {
            $flagAction = $this->getTable()->changeStatus($this->_params['data'], array('task' => 'change-special'));
            if ($flagAction == true)
                $this->flashMessenger()->addMessage('Trạng thái của phần tử đã được cập nhật thành công!');
        }
        $this->goAction();
    }

    public function multiStatusAction() {
        $message = 'Vui lòng chọn vào phần tử mà bạn muốn thay đổi trạng thái!';
        if ($this->getRequest()->isPost()) {
            $flagAction = $this->getTable()->changeStatus($this->_params['data'], array('task' => 'change-multi-status'));
            if ($flagAction == true)
                $message = 'Trạng thái của phần tử đã được cập nhật thành công!';
        }
        $this->flashMessenger()->addMessage($message);
        $this->goAction();
    }

    public function orderingAction() {
        $message = 'Vui lòng chọn vào phần tử mà bạn muốn thay đổi thứ tự sắp xếp!';
        if ($this->getRequest()->isPost()) {
            $flagAction = $this->getTable()->ordering($this->_params['data']);
            if ($flagAction == true)
                $message = 'Thứ tự sắp xếp phần tử đã được cập nhật thành công!';
        }
        $this->flashMessenger()->addMessage($message);
        $this->goAction();
    }

    public function deleteAction() {
        $message = 'Vui lòng chọn vào phần tử mà bạn muốn xóa!';
        if ($this->getRequest()->isPost()) {
            $flagAction = $this->getTable()->deleteItem($this->_params['data'], array('task' => 'multi-delete'));
            if ($flagAction == true)
                $message = 'Các phần tử đã được xóa thành công!';
        }
        $this->flashMessenger()->addMessage($message);
        $this->goAction('admin', array('controller' => 'product'));
    }

    public function formAction() {
        $helperString = new \Ocoder\Helper\String;
        
        $myForm = $this->getForm();
        $task = 'add-item';
        $this->_params['data']['id'] = $this->params('id');

        if (!empty($this->_params['data']['id'])) {
            $item = $this->getTable()->getItem($this->_params['data']);

            if (!empty($item)) {

                $nameLang = json_decode($item->name_lang);
                $item->name_en = $nameLang->name_en;
                $item->name_jp = $nameLang->name_jp;
                $introLang = json_decode($item->intro_lang);
                $item->intro_en = $introLang->intro_en;
                $item->intro_jp = $introLang->intro_jp;
                $descriptionLang = json_decode($item->description_lang);
                $item->description_en = $descriptionLang->description_en;
                $item->description_jp = $descriptionLang->description_jp;
                $keywordLang = json_decode($item->keyword_lang);
                $item->keyword_en = $keywordLang->keyword_en;
                $item->keyword_jp = $keywordLang->keyword_jp;

//                $myForm->setInputFilter(new \Admin\Form\ProductFilter(array('id' => $this->_params['data']['id'])));
               
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

            $this->_params['data']['intro'] = stripslashes($this->_params['data']['intro']);
            $this->_params['data']['intro_lang'] = json_encode(
                    array(
                        'intro_en' => trim($this->_params['data']['intro_en']) ? stripslashes($this->_params['data']['intro_en']) : $this->_params['data']['intro'],
                        'intro_jp' => trim($this->_params['data']['intro_jp']) ? stripslashes($this->_params['data']['intro_jp']) : $this->_params['data']['intro'],
            ));
            unset($this->_params['data']['intro_en']);
            unset($this->_params['data']['intro_jp']);

            $this->_params['data']['description'] = stripslashes($this->_params['data']['description']);
            $this->_params['data']['description_lang'] = json_encode(
                    array(
                        'description_en' => trim($this->_params['data']['description_en']) ? stripslashes($this->_params['data']['description_en']) : $this->_params['data']['description'],
                        'description_jp' => trim($this->_params['data']['description_jp']) ? stripslashes($this->_params['data']['description_jp']) : $this->_params['data']['description'],
            ));
            unset($this->_params['data']['description_en']);
            unset($this->_params['data']['description_jp']);

            $this->_params['data']['keyword_lang'] = json_encode(
                    array(
                        'keyword_en' => trim($this->_params['data']['keyword_en']) ? $this->_params['data']['keyword_en'] : $this->_params['data']['keyword'],
                        'keyword_jp' => trim($this->_params['data']['keyword_jp']) ? $this->_params['data']['keyword_jp'] : $this->_params['data']['keyword'],
            ));
            unset($this->_params['data']['keyword_en']);
            unset($this->_params['data']['keyword_jp']);

            $this->_params['data']['status'] = ($this->_params['data']['status'] == 'active') ? 1 : 0;
            $this->_params['data']['special'] = ($this->_params['data']['special'] == 'yes') ? 1 : 0;
            unset($this->_params['data']['action']);
            
            $id = $this->getTable()->saveItem($this->_params['data'], array('task' => $task));
            
            $this->flashMessenger()->addMessage('Dữ liệu đã được lưu thành công!');
            if ($action == 'save-close')
                $this->goAction('admin', array('controller' => 'product'));
            if ($action == 'save-new')
                $this->goAction('admin', array('controller' => 'product', 'action' => 'form'));
            if ($action == 'save')
                $this->goAction('admin', array('controller' => 'product', 'action' => 'form', 'id' => $id));
//            }
        }

        return new ViewModel(array(
            'myForm' => $myForm,
        ));
    }

}

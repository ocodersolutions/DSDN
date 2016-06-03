<?php

namespace Admin\Controller;

use Ocoder\Base\BaseActionController as OcoderActionController;
use Zend\Form\FormInterface;
use Zend\Session\Container;
use Zend\View\Model\ViewModel;
use Ocoder\Paginator\Paginator as OcoderPaginator;

class ProductCategoryController extends OcoderActionController {

    public function init() {

        // SESSION FILTER
        $ssFilter = new Container(__CLASS__);
        $this->_params['ssFilter']['order_by'] = 'left';
        $this->_params['ssFilter']['order'] = 'DESC';
        $this->_params['ssFilter']['filter_status'] = $ssFilter->filter_status;
        $this->_params['ssFilter']['filter_level'] = $ssFilter->filter_level;
        $this->_params['ssFilter']['filter_keyword_type'] = $ssFilter->filter_keyword_type;
        $this->_params['ssFilter']['filter_keyword_value'] = $ssFilter->filter_keyword_value;

        // PAGINATOR
        $this->_paginator['itemCountPerPage'] = 10;
        $this->_paginator['pageRange'] = 4;
        $this->_paginator['currentPageNumber'] = $this->params()->fromRoute('page', 1);
        $this->_params['paginator'] = $this->_paginator;

        // OPTIONS
        $this->_options['modelTable'] = 'Admin\Model\ProductCategoryTable';
        $this->_options['formName'] = 'formAdminProductCategory';

        // DATA
        $this->_params['data'] = array_merge(
                $this->getRequest()->getPost()->toArray(), $this->getRequest()->getFiles()->toArray()
        );
    }

    public function indexAction() {
        $this->_params['ssFilter']['filter_level'] = 1;

        $total = $this->getTable()->countItem($this->_params, array('task' => 'list-item'));
        $items = $this->getTable()->listItem($this->_params, array('task' => 'list-item'));
        $slbLevel = $this->getTable()->itemInSelectbox(null, array('task' => 'list-level'));
        return new ViewModel(array(
            'items' => $items,
            'paginator' => OcoderPaginator::createPaginator($total, $this->_params['paginator']),
            'ssFilter' => $this->_params['ssFilter'],
            'slbLevel' => $slbLevel,
        ));
    }

    public function filterAction() {
        if ($this->getRequest()->isPost()) {
            $ssFilter = new Container(__CLASS__);
            $data = $this->_params['data'];
            $ssFilter->order_by = $data['order_by'];
            $ssFilter->order = $data['order'];
            $ssFilter->filter_status = $data['filter_status'];
            $ssFilter->filter_level = $data['filter_level'];
            $ssFilter->filter_group = $data['filter_group'];
            $ssFilter->filter_keyword_type = $data['filter_keyword_type'];
            $ssFilter->filter_keyword_value = $data['filter_keyword_value'];

            $btnClear = $data['btn-clear'];

            if ($btnClear == 'btn-clear') {
                $ssFilter->offsetUnset('filter_keyword_type');
                $ssFilter->offsetUnset('filter_keyword_value');
            }
        }
        $this->goAction('admin', array('controller' => $this->_params['controller']));
    }

    public function statusAction() {
        if ($this->getRequest()->isPost()) {
            $flagAction = $this->getTable()->changeStatus($this->_params['data'], array('task' => 'change-status'));
            if ($flagAction == true)
                $this->flashMessenger()->addMessage('Trạng thái của phần tử đã được cập nhật thành công!');
        }
        $this->goAction();
    }

    public function moveAction() {
        if ($this->getRequest()->isPost()) {
            $flagAction = $this->getTable()->moveItem($this->_params['data']);
            if ($flagAction == true)
                $this->flashMessenger()->addMessage('Thứ tự của phần tử đã được cập nhật thành công!');
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
        $this->goAction('admin');
    }

    public function formAction() {
        $helperString = new \Ocoder\Helper\String;

        $myForm = $this->getForm();
        $task = 'add-item';
        $this->_params['data']['id'] = $this->params('id');

        if (!empty($this->_params['data']['id'])) {
            $item = $this->getTable()->getItem($this->_params['data']);
            if (!empty($item)) {
//                $myForm->setInputFilter(new \Admin\Form\CategoryFilter(array('id' => $this->_params['data']['id'])));
                $nameLang = json_decode($item->name_lang);
                $item->name_en = $nameLang->name_en;
                $item->name_jp = $nameLang->name_jp;
                $descriptionLang = json_decode($item->description_lang);
                $item->description_en = $descriptionLang->description_en;
                $item->description_jp = $descriptionLang->description_jp;
                $keywordLang = json_decode($item->keyword_lang);
                $item->keyword_en = $keywordLang->keyword_en;
                $item->keyword_jp = $keywordLang->keyword_jp;

                $myForm->bind($item);
                $task = 'edit-item';
            }
        } else {
            unset($this->_params['data']['id']);
        }

        if ($this->getRequest()->isPost()) {

            $action = $this->_params['data']['action'];
            unset($this->_params['data']['action']);

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

            $this->_params['data']['description_lang'] = json_encode(
                    array(
                        'description_en' => trim($this->_params['data']['description_en']) ? $this->_params['data']['description_en'] : $this->_params['data']['description'],
                        'description_jp' => trim($this->_params['data']['description_jp']) ? $this->_params['data']['description_jp'] : $this->_params['data']['description'],
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

            $this->_params['data']['parent'] = $this->_params['data']['parent'] ? $this->_params['data']['parent'] : 1;

//            $myForm->setData($this->_params['data']);
//            if ($myForm->isValid()) {
//                $this->_params['data'] = $myForm->getData(FormInterface::VALUES_AS_ARRAY);
            $id = $this->getTable()->saveItem($this->_params['data'], array('task' => $task));
            $this->flashMessenger()->addMessage('Dữ liệu đã được lưu thành công!');

            $this->goAction('admin', array('action' => 'form', 'id' => $id));
            if ($action == 'save-close')
                $this->goAction('admin');
            if ($action == 'save-new')
                $this->goAction('admin', array('action' => 'form'));
            if ($action == 'save')
                $this->goAction('admin', array('action' => 'form', 'id' => $id));
//            }
        }

        return new ViewModel(array(
            'myForm' => $myForm,
        ));
    }

}

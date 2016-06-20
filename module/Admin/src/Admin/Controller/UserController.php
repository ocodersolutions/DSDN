<?php

namespace Admin\Controller;

use Zend\Form\FormInterface;
use Zend\Session\Container;
use Zend\View\Model\ViewModel;
use Ocoder\Paginator\Paginator as OcoderPaginator;
use Ocoder\Base\BaseActionController;

class UserController extends BaseActionController {

    public function init() {

        // OPTIONS
        $this->_options['tableName'] = TABLE_USERS;
        $this->_options['modelTable'] = 'Admin\Model\UserTable';
        $this->_options['formName'] = 'formAdminUser';
        // DATA
        $this->_params['data'] = $this->getRequest()->getPost()->toArray();

        // Check login
        $this->getAuthService();
        if (!$this->_authService->hasIdentity()) {
            $this->goAction('admin', array('controller' => 'account', 'action' => 'login'));
        }
    }

    public function indexAction() {
        
        // SESSION FILTER
        $ssFilter = new Container(__CLASS__);
        $this->_params['ssFilter']['order_by'] = !empty($ssFilter->order_by) ? $ssFilter->order_by : 'id';
        $this->_params['ssFilter']['order'] = !empty($ssFilter->order) ? $ssFilter->order : 'DESC';
        $this->_params['ssFilter']['filter_published'] = $ssFilter->filter_published;
        $this->_params['ssFilter']['filter_group'] = $ssFilter->filter_group;
        $this->_params['ssFilter']['filter_keyword_type'] = array('username', 'email', 'fullname', 'id');
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

    public function filterAction() {
        if ($this->getRequest()->isPost()) {
            $ssFilter = new Container(__CLASS__);
            $data = $this->_params['data'];
            $ssFilter->order_by = $data['order_by'];
            $ssFilter->order = $data['order'];
            $ssFilter->filter_published = $data['filter_published'];
            $ssFilter->filter_group = $data['filter_group'];
            $ssFilter->filter_keyword_type = $data['filter_keyword_type'];
            $ssFilter->filter_keyword_value = $data['filter_keyword_value'];

            $btnClear = $data['btn-clear'];

            if ($btnClear == 'btn-clear') {
                $ssFilter->offsetUnset('filter_keyword_type');
                $ssFilter->offsetUnset('filter_keyword_value');
            }
        }
        $this->goAction('admin', array('controller' => 'user', 'action' => 'index'));
    }

    public function publishedAction() {
        if ($this->getRequest()->isPost()) {
            $flagAction = $this->getTable()->changePublished($this->_params['data'], array('task' => 'change-published'));
            if ($flagAction == true) {
                $this->flashMessenger()->addSuccessMessage(UPDATE_PUBLISHED_SUCCESS);
            } else {
                $this->flashMessenger()->addErrorMessage(HAVE_ERROR);
            }
        }
        $this->goAction('admin', array('controller' => 'user', 'action' => 'index'));
    }

    public function formAction() {

        $myForm = $this->getForm();
        $task = 'add-item';
        $this->_params['data']['id'] = $this->params('id');

        if (!empty($this->_params['data']['id'])) {
            $item = $this->getTable()->getItem($this->_params['data']);
            if (!empty($item)) {
//                $myForm->setInputFilter(new \Admin\Form\UserFilter(array('id' => $this->_params['data']['id'])));
                $myForm->bind($item);
                $task = 'edit-item';
            }
        }

        if ($this->getRequest()->isPost()) {
           
            $action = $this->_params['data']['action'];
            $myForm->setData($this->_params['data']);
 
            if ($myForm->isValid()) {
                $this->_params['data'] = $myForm->getData(FormInterface::VALUES_AS_ARRAY);
                $id = $this->getTable()->saveItem($this->_params['data'], array('task' => $task));
                if ($id == true) {
                    $this->flashMessenger()->addSuccessMessage(UPDATE_SUCCESS);
                } else {
                    $this->flashMessenger()->addErrorMessage(HAVE_ERROR);
                }
                if ($action == 'save-close')
                    $this->goAction('admin', array('action' => 'index'));
                if ($action == 'save-new')
                    $this->goAction('admin', array('action' => 'form'));
                if ($action == 'save')
                    $this->goAction('admin', array('action' => 'form', 'id' => $id));
            }
        }

        return new ViewModel(array(
            'myForm' => $myForm,
        ));
    }

    public function deleteAction() {
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

//
//    public function multiPublishedAction() {
//        $message = 'Vui lòng chọn vào phần tử mà bạn muốn thay đổi trạng thái!';
//        if ($this->getRequest()->isPost()) {
//            $flagAction = $this->getTable()->changePublished($this->_params['data'], array('task' => 'change-multi-published'));
//            if ($flagAction == true)
//                $message = 'Trạng thái của phần tử đã được cập nhật thành công!';
//        }
//        $this->flashMessenger()->addMessage($message);
//        $this->goAction();
//    }
//
//    public function orderingAction() {
//        $message = 'Vui lòng chọn vào phần tử mà bạn muốn thay đổi thứ tự sắp xếp!';
//        if ($this->getRequest()->isPost()) {
//            $flagAction = $this->getTable()->ordering($this->_params['data']);
//            if ($flagAction == true)
//                $message = 'Thứ tự sắp xếp phần tử đã được cập nhật thành công!';
//        }
//        $this->flashMessenger()->addMessage($message);
//        $this->goAction();
//    }
//
//    public function deleteAction() {
//        $message = 'Vui lòng chọn vào phần tử mà bạn muốn xóa!';
//        if ($this->getRequest()->isPost()) {
//            $flagAction = $this->getTable()->deleteItem($this->_params['data'], array('task' => 'multi-delete'));
//            if ($flagAction == true)
//                $message = 'Các phần tử đã được xóa thành công!';
//        }
//        $this->flashMessenger()->addMessage($message);
//        $this->goAction();
//    }
//
}

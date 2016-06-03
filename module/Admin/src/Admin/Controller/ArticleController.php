<?php

namespace Admin\Controller;

use Zend\Form\FormInterface;
use Zend\Session\Container;
use Zend\View\Model\ViewModel;
use Ocoder\Paginator\Paginator as OcoderPaginator;
use Ocoder\Base\BaseActionController as OcoderBaseController;

class ArticleController extends OcoderBaseController {

    public function init() {
        // OPTIONS
        $this->_options['tableName'] = TABLE_ARTICLES;
        $this->_options['modelTable'] = 'Admin\Model\ArticleTable';
        $this->_options['formName'] = 'formAdminArticle';

        // Check login
        $this->getAuthService();
        if (!$this->_authService->hasIdentity()) {
            $this->goAction('admin', array('controller' => 'account', 'action' => 'login'));
        }

        // DATA
        $this->_params['data'] = array_merge(
                $this->getRequest()->getPost()->toArray(), $this->getRequest()->getFiles()->toArray()
        );
    }

    public function newAction() {
        $helperString = new \Ocoder\Helper\String;
        $myForm = $this->getForm();
        $task = 'add-item';
        $categoryId = $this->params('id');
        $categoryTableGateway = $this->getServiceLocator()->get('Admin\Model\CategoryTable');
        $category = $categoryTableGateway->getItem(array('id' => $categoryId));

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

            $this->_params['data']['content'] = stripslashes($this->_params['data']['content']);
            $this->_params['data']['content_lang'] = json_encode(
                    array(
                        'content_en' => trim($this->_params['data']['content_en']) ? stripslashes($this->_params['data']['content_en']) : $this->_params['data']['content'],
                        'content_jp' => trim($this->_params['data']['content_jp']) ? stripslashes($this->_params['data']['content_jp']) : $this->_params['data']['content'],
            ));
            unset($this->_params['data']['content_en']);
            unset($this->_params['data']['content_jp']);

            $this->_params['data']['keyword_lang'] = json_encode(
                    array(
                        'keyword_en' => trim($this->_params['data']['keyword_en']) ? $this->_params['data']['keyword_en'] : $this->_params['data']['keyword'],
                        'keyword_jp' => trim($this->_params['data']['keyword_jp']) ? $this->_params['data']['keyword_jp'] : $this->_params['data']['keyword'],
            ));
            unset($this->_params['data']['keyword_en']);
            unset($this->_params['data']['keyword_jp']);

//            $this->_params['data']['status'] = ($this->_params['data']['status'] == 'active') ? 1 : 0;
            $this->_params['data']['category_id'] = $categoryId;

            unset($this->_params['data']['action']);

            $id = $this->getTable()->saveItem($this->_params['data'], array('task' => $task));
            $this->flashMessenger()->addMessage('Dữ liệu đã được lưu thành công!');
            if ($action == 'save-close')
                $this->goAction('admin', array('controller' => 'category', 'action' => 'detail', 'id' => $categoryId));
            if ($action == 'save-new')
                $this->goAction('admin', array('controller' => 'article', 'action' => 'form'));
            if ($action == 'save')
                $this->goAction('admin', array('controller' => 'article', 'action' => 'form', 'id' => $id));
//            }
        }

        return new ViewModel(array(
            'myForm' => $myForm,
            'category' => $category,
        ));
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
                $contentLang = json_decode($item->content_lang);
                $item->content_en = $contentLang->content_en;
                $item->content_jp = $contentLang->content_jp;
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
            
            
            $this->_params['data']['intro'] = stripslashes($this->_params['data']['intro']);
            $this->_params['data']['intro_lang'] = json_encode(
                    array(
                        'intro_en' => trim($this->_params['data']['intro_en']) ? stripslashes($this->_params['data']['intro_en']) : $this->_params['data']['intro'],
                        'intro_jp' => trim($this->_params['data']['intro_jp']) ? stripslashes($this->_params['data']['intro_jp']) : $this->_params['data']['intro'],
            ));
            unset($this->_params['data']['intro_en']);
            unset($this->_params['data']['intro_jp']);

            $this->_params['data']['content'] = stripslashes($this->_params['data']['content']);
            $this->_params['data']['content_lang'] = json_encode(
                    array(
                        'content_en' => trim($this->_params['data']['content_en']) ? stripslashes($this->_params['data']['content_en']) : $this->_params['data']['content'],
                        'content_jp' => trim($this->_params['data']['content_jp']) ? stripslashes($this->_params['data']['content_jp']) : $this->_params['data']['content'],
            ));
            unset($this->_params['data']['content_en']);
            unset($this->_params['data']['content_jp']);

            $this->_params['data']['keyword_lang'] = json_encode(
                    array(
                        'keyword_en' => trim($this->_params['data']['keyword_en']) ? $this->_params['data']['keyword_en'] : $this->_params['data']['keyword'],
                        'keyword_jp' => trim($this->_params['data']['keyword_jp']) ? $this->_params['data']['keyword_jp'] : $this->_params['data']['keyword'],
            ));
            unset($this->_params['data']['keyword_en']);
            unset($this->_params['data']['keyword_jp']);

            $this->_params['data']['status'] = ($this->_params['data']['status'] == 'active') ? 1 : 0;
            unset($this->_params['data']['action']);

            $id = $this->getTable()->saveItem($this->_params['data'], array('task' => $task));
            $this->flashMessenger()->addMessage('Dữ liệu đã được lưu thành công!');
            if ($action == 'save-close')
//                $this->goAction('admin', array('controller' => 'article'));
                if ($action == 'save-new')
                    $this->goAction('admin', array('controller' => 'article', 'action' => 'form'));
            if ($action == 'save')
                $this->goAction('admin', array('controller' => 'article', 'action' => 'form', 'id' => $id));
//            }
        }

        return new ViewModel(array(
            'myForm' => $myForm,
            'item' => $item,
        ));
    }

}

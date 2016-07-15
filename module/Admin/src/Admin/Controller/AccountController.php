<?php

namespace Admin\Controller;

use Zend\Form\FormInterface;
use Zend\Session\Container;
use Zend\View\Model\ViewModel;
use Ocoder\Paginator\Paginator as OcoderPaginator;
use Ocoder\Base\BaseActionController;

class AccountController extends BaseActionController {

    public function init() {
        // OPTIONS
        $this->_options['tableName'] = TABLE_USERS;
        $this->_options['modelTable'] = 'Admin\Model\UserTable';
        $this->_options['formName'] = 'formApplicationUser';
        // Check login
        $this->getAuthService();
        if (!$this->_authService->hasIdentity() && $this->_params['action'] != 'login' && $this->_authService->getStorage()->read()->published != 1 ) {
            $this->goAction('admin', array('controller' => 'account', 'action' => 'login'));
        }
    }

    public function loginAction() {
        $msgError = '';
        if ($this->_authService->hasIdentity() && $this->_authService->getStorage()->read()->published == 1) {
            $this->goAction('admin', array('controller' => 'index'));
        }
        
        $myForm = $this->getServiceLocator()->get('FormElementManager')->get('formAdminLogin');
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            //check authentication...
            $this->_authService->getAdapter()
                    ->setIdentity($request->getPost('username'))
                    ->setCredential($request->getPost('password'));

            $result = $this->_authService->authenticate();
            
            if ($result->isValid()) {
                $userInfo = $this->_authService->getAdapter()->getResultRowObject(array('id', 'username', 'email', 'fullname', 'published'));
                $this->_authService->getStorage()->write($userInfo);
                if($userInfo->published == 1) {
                    $this->goAction('admin', array('controller' => 'index'));
                } else {
                   $this->redirect()->toUrl(URL_APPLICATION);
                }
            } else {
                $msgError = USERNAME_OR_PASSWORD_INVALID;
            }
        }

        return array(
            'myForm' => $myForm,
            'msgError' => $msgError,
        );
    }
    
    public function logoutAction() {
        $this->_authService->clearIdentity();
        return $this->redirect()->toUrl(URL_APPLICATION . '/admin/account/login');
    }

}

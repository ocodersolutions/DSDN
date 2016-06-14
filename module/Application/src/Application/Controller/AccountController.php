<?php

namespace Application\Controller;

use Zend\Form\FormInterface;
use Zend\Session\Container;
use Zend\View\Model\ViewModel;
use Ocoder\Paginator\Paginator as OcoderPaginator;
use Ocoder\Base\BaseActionController;

class AccountController extends BaseActionController {

    public function init() {
        // OPTIONS
        $this->_options['tableName'] = TABLE_USERS;
        $this->_options['modelTable'] = 'Application\Model\UserTable';
        $this->_options['formName'] = 'formApplicationUser';
        
        // Check login
        $this->getAuthService();
        if (!$this->_authService->hasIdentity() && $this->_params['action'] != 'login') {
            $this->goAction('application', array('controller' => 'account', 'action' => 'login'));
        }
    }

    public function loginAction() {
        $msgError = '';
        
        if ($this->getAuthService()->hasIdentity()){
            return $this->redirect()->toRoute('document');
        }
        
        $myForm = $this->getServiceLocator()->get('FormElementManager')->get('formApplicationLogin');
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            //check authentication...
            $this->_authService->getAdapter()
                    ->setIdentity($request->getPost('username'))
                    ->setCredential($request->getPost('password'));

            $result = $this->_authService->authenticate();
            
            if ($result->isValid()) {
                $userInfo = $this->_authService->getAdapter()->getResultRowObject(array('id', 'username', 'email', 'fullname'));
                $this->_authService->getStorage()->write($userInfo);
                return $this->redirect()->toRoute('document');
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
        return $this->redirect()->toUrl(URL_APPLICATION . '/application/account/login');
    }

}

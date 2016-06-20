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
        // DATA
        $this->_params['data'] = array_merge(
            $this->getRequest()->getPost()->toArray(), $this->getRequest()->getFiles()->toArray()
        );
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
    public function editAction() {
        

        $userLogged = $this->getServiceLocator()->get('AuthService')->getStorage()->read();
        $id = $userLogged->id;
        $userTableGateway = $this->getServiceLocator()->get('Application\Model\UserTable');
        $userInfo = $userTableGateway->getItem(array('id' => $id));
        //var_dump($userInfo);
        $task = 'edit-item';
        $request = $this->getRequest();
        if ($request->isPost()) {
           //var_dump($this->_params['data']['link']['name']);die;
            $fileName='link';
            if($_FILES[$fileName]["size"]) {
                $target_dir = PATH_PUBLIC . "/uploads/avatar/";
                $uploadOk = 1;
                $imageFileType = pathinfo(basename($_FILES[$fileName]["name"]), PATHINFO_EXTENSION);
                $target_file = $target_dir . $id . '_' . '.' . $imageFileType;
                // Check if image file is a actual image or fake image
                $check = getimagesize($_FILES[$fileName]["tmp_name"]);
                if($check === false) {
                    // $this->_ssSystem->offsetSet('message', array('type' => 'update', 'status' => 'danger', 'content' => FILE_NOT_IMAGE));
                    $uploadOk = 0;
                }
                // Check size
                if ($_FILES[$fileName]["size"] > 2097152) {
                    // $this->_ssSystem->offsetSet('message', array('type' => 'update', 'status' => 'danger', 'content' => MAX_SIZE_2M));
                    $uploadOk = 0;
                }
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk != 0) {
                    if (move_uploaded_file($_FILES[$fileName]["tmp_name"], $target_file)) {
                        $linkUpload = $id . '.' . $imageFileType;
                        $this->_params['data']['avatar']=$linkUpload;
                    }
                
                }
                //$data = $userTableGateway->saveItem(array('id' => $userId));
                $userTableGateway->saveItem($this->_params['data'], array('task' => $task));
              //  print_r('data');    
              $this->goAction('application', array('action' => 'edit'));
            }  
            
        }
        // if sumbmit update
        //if ($action == 'update')
            
        // use in view

        return new ViewModel(array(
            'userInfo'=>$userInfo,
        ));
    }
}

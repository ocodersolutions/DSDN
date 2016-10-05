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
    private $userLogged;
    
    

    public function init() {

        // Check login
        $this->getAuthService();
        if (!$this->_authService->hasIdentity() && $this->_params['action'] != 'login') {
            $this->goAction('application', array('controller' => 'account', 'action' => 'login'));
        }

        // DATA
        $this->_params['data'] = array_merge(
            $this->getRequest()->getPost()->toArray(), $this->getRequest()->getFiles()->toArray()
        );

        $this->userLogged = $this->getServiceLocator()->get('AuthService')->getStorage()->read();
        
    }
    
    //Get all Documents
    public function indexAction()
    {
        $this->_viewHelper->get('HeadTitle')->prepend(DOCUMENT . ' - ' . $this->_configs->title);
        $stringHelperOcoder = new \Ocoder\Helper\String();
        $documentTableGateway = $this->getServiceLocator()->get('Admin\Model\DocumentTable');
        $userTableGateway = $this->getServiceLocator()->get('Admin\Model\UserTable');
        $userInfo = $userTableGateway->getItem(array('id' => $this->userLogged->id));

        unset($this->_params['ssFilter']);
        $this->_paginator['currentPageNumber'] = 1;
        $this->_paginator['itemCountPerPage'] = 3000;
        $this->_params['paginator'] = $this->_paginator;

        // $this->_params['ssFilter']['filter_keyword_type'] = array('alias', 'alias_lang');
        // $this->_params['ssFilter']['filter_keyword_value'] = $aliasCategory;
        $docArrCurrentMonth = $documentTableGateway->listItemCurrentMonth();

        $docArrOld = $documentTableGateway->listItemOld();

        

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
            'docArrCurrentMonth' => $docArrCurrentMonth,
            'userLogged' => $this->userLogged,
            'userInfo' => $userInfo,
            'docArrOld'=>$docArrOld,

            // 'categoryNews' => $categoryNews,
            // 'paginator' => OcoderPaginator::createPaginator($countArticles, $this->_params['paginator']),
        ));
    }

    //Upload Document
    public function uploadAction()
    {
        $getfileType= $this->getServiceLocator()->get('Admin\Model\ConfigTable');
        $fileType=$getfileType->getItem(array('id' => 1));
        $arrDocType=(explode(',',$fileType->filetype_doc) );
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $documentTableGateway = $this->getServiceLocator()->get('Admin\Model\DocumentTable');

            $task='add-item' ;
            $fileUploadName = 'link';
            if($_FILES[$fileUploadName]["size"]) {
                $target_dir = PATH_PUBLIC_DOCUMENTS . "/";
                $uploadOk = 1;
                $imageFileType = pathinfo(basename($_FILES[$fileUploadName]["name"]), PATHINFO_EXTENSION);
                $fileName = time() . '.' . $imageFileType;
                $target_file = $target_dir . $fileName;
                // Check if image file is a actual image or fake image
                 $check = getimagesize($_FILES[$fileUploadName]["tmp_name"]);
                 // if($check === false) {
                 // //$this->_ssSystem->offsetSet('message', array('type' => 'update', 'status' => 'danger', 'content' => FILE_NOT_IMAGE));
                 //     $uploadOk = 0;
                 // }
                 // Check size
                 if ($_FILES[$fileUploadName]["size"] > 2097152) {
                 //$this->_ssSystem->offsetSet('message', array('type' => 'update', 'status' => 'danger', 'content' => MAX_SIZE_2M));
                    $uploadOk = 0;
                    
                 }
                 
                // Check file type
                if (in_array($imageFileType,$arrDocType)) {
                    //$this->_ssSystem->offsetSet('message', array('type' => 'update', 'status' => 'danger', 'content' => MAX_SIZE_2M));
                    $uploadOk = 1;
                    
                }
                  
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk != 0) {
                    if (move_uploaded_file($_FILES[$fileUploadName]["tmp_name"], $target_file)) {
                        $this->_params['data']['link'] = $fileName;
                    }
                    $documentTableGateway->saveItem($this->_params['data'], array('task' => $task));
                }
            }
            
            //$documentTableGateway->saveItem($this->_params['data'], array('task' => $task));
           //if($DocumentTable->saveItem(array('id' => $this->->id, 'banners' => json_encode($bannerArr)))){
                //$this->_ssSystem->offsetSet('message', array('type' => 'update', 'status' => 'success', 'content' => 'Cập nhật thành công'));
             //} else {
                //$this->_ssSystem->offsetSet('message', array('type' => 'update', 'status' => 'danger', 'content' => ''));
             //}
        }
        return new ViewModel(array(
            'userLogged' => $this->userLogged
        ));
    }
}
    
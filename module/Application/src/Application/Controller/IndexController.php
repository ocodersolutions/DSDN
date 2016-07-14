<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Session\Container;
use Zend\View\Model\ViewModel;
use Zend\Mail;
use Ocoder\Base\BaseActionController as OcoderBaseController;


use Zend\Mail\Message;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;


class IndexController extends OcoderBaseController
{
    public function init() {
       
    }
    
    public function indexAction()
    {   
        
        //set Head info
        $this->_viewHelper->get('HeadTitle')->prepend($this->_configs->title);
        $this->_viewHelper->get('HeadMeta')->setName('keywords', $this->_configs->keywords);
        $this->_viewHelper->get('HeadMeta')->setName('description', $this->_configs->description);
        
        $productTableGateway = $this->getServiceLocator()->get('Admin\Model\ProductTable');
        $articleTableGateway = $this->getServiceLocator()->get('Admin\Model\ArticleTable');
        $bannerTableGateway = $this->getServiceLocator()->get('Admin\Model\BannerTable');
        $partnerTableGateway = $this->getServiceLocator()->get('Admin\Model\PartnerTable');
        
        $this->_paginator['currentPageNumber'] = $this->params()->fromRoute('page', 1);
        $this->_params['paginator'] = $this->_paginator;
        
        $this->_params['ssFilter']['filter_special'] = 'yes';
        $this->_params['ssFilter']['order_by'] = 'id';
        $this->_params['ssFilter']['order'] = 'DESC';
        $featuredProducts = $productTableGateway->listItem($this->_params, array('task' => 'list-item'));
        
        unset($this->_params['ssFilter']);
        $this->_params['paginator']['itemCountPerPage'] = 4;
        $this->_params['ssFilter']['order_by'] = 'id';
        $this->_params['ssFilter']['order'] = 'ASC';
        $this->_params['ssFilter']['filter_category'] = SERVICE_CATEGORY_ID;
        $services = $articleTableGateway->listItem($this->_params, array('task' => 'list-item'));
        
        unset($this->_params['ssFilter']);
        $this->_params['paginator']['itemCountPerPage'] = 20;
        $this->_params['ssFilter']['order_by'] = 'id';
        $this->_params['ssFilter']['order'] = 'DESC';
        $banners = $bannerTableGateway->listItem($this->_params, array('task' => 'list-item'));

       
        $partners= $partnerTableGateway->listItem($this->_params, array('task' => 'list-item'));

        return new ViewModel(array(
            'featuredProducts' => $featuredProducts,
            'services' => $services,
            'banners' => $banners,
            'partners' => $partners,
        ));
    }
    
   public function contactAction()
    {
        //$adminmail=$this->$ssSystem->configs->admin_mail;
        if ($this->getRequest()->isPost()) {
            $adminmail=$this->_configs->admin_email;
            $name=$this->getRequest()->getPost('full_name');
            $from=$this->getRequest()->getPost('email');
            $title=$this->getRequest()->getPost('tittle');
            $content=$this->getRequest()->getPost('comment');
            $message = new Message();
            $message->addTo($adminmail)
                    ->addFrom('ocodermail@yahoo.com')
                    ->setSubject($title);

            $bodyPart = new \Zend\Mime\Message();

            $bodyMessage = new \Zend\Mime\Part("<b> Liên hệ từ khách hàng : </b>".$name."<br/><b>Email khách hàng : </b>".$from."<br/><b> Nội dung phản hồi : </b>".$content);
            $bodyMessage->type = 'text/html';

            $bodyPart->setParts(array($bodyMessage));
            $message->setBody($bodyPart);

            // Setup SMTP transport using LOGIN authentication
            $transport = new SmtpTransport();
            $options   = new SmtpOptions(array(
                'name'              => 'smtp.mail.yahoo.com',
                'host'              => 'smtp.mail.yahoo.com',
                'connection_class'  => 'login',
                'connection_config' => array(
                    'username' => 'ocodermail@yahoo.com',
                    'password' => 'Vf5IadKD',
                    //'ssl'=> 'tls',
                    'ssl'=> 'ssl',
                ),
            ));
            $transport->setOptions($options);
            $transport->send($message);
        }
        //set Head info
        $this->_viewHelper->get('HeadTitle')->prepend(TITLE_CONTACT . ' - ' . $this->_configs->title);
        $this->_viewHelper->get('HeadMeta')->setName('keywords', $this->_configs->keywords);
        $this->_viewHelper->get('HeadMeta')->setName('description', $this->_configs->description);
    }
    public function acmailerAction ()
    {   
        if ($this->getRequest()->isPost()) {
        $mailService = $this->getServiceLocator()->get('AcMailer\Service\MailService');
        $mailService->setSubject('This is the subject')
                    ->setBody('This is the body'); // This can be a string, HTML or even a zend\Mime\Message or a Zend\Mime\Part

        $result = $mailService->send();
        if ($result->isValid()) {
            echo 'Message sent. Congratulations!';
        } else {
            if ($result->hasException()) {
                echo sprintf('An error occurred. Exception: \n %s', $result->getException()->getTraceAsString());
            } else {
                echo sprintf('An error occurred. Message: %s', $result->getMessage());
            }
        }

        return false;
       }

    }
    public function searchAction() {
        //set Head info
        $this->_viewHelper->get('HeadTitle')->prepend(TITLE_SEARCH . ' - ' . $this->_configs->title);
        $this->_viewHelper->get('HeadMeta')->setName('keywords', $this->_configs->keywords);
        $this->_viewHelper->get('HeadMeta')->setName('description', $this->_configs->description);
        
        $productTableGateway = $this->getServiceLocator()->get('Admin\Model\ProductTable');
        $articleTableGateway = $this->getServiceLocator()->get('Admin\Model\ArticleTable');
        
        $this->_paginator['currentPageNumber'] = $this->params()->fromRoute('page', 1);
        $this->_params['paginator'] = $this->_paginator;
        $this->_params['ssFilter']['filter_keyword_type'] = array('name');
        $this->_params['ssFilter']['filter_keyword_value'] = trim($_GET['tk']);
        $products = $productTableGateway->listItem($this->_params, array('task' => 'list-item'));
        $articles = $articleTableGateway->listItem($this->_params, array('task' => 'list-item'));
        
        return new ViewModel(array(
            'products' => $products,
            'articles' => $articles,
            'keyword'  => $_GET['tk'],
        ));
    }

	public function googleAction(){
		echo 'google-site-verification: google46462e6475c9b871.html';
		return $this->getResponse();
	}
}

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
        
        $this->_paginator['currentPageNumber'] = $this->params()->fromRoute('page', 1);
        $this->_params['paginator'] = $this->_paginator;
        
        $this->_params['ssFilter']['filter_special'] = 'yes';
        $this->_params['ssFilter']['order_by'] = 'id';
        $this->_params['ssFilter']['order'] = 'DESC';
        $featuredProducts = $productTableGateway->listItem($this->_params, array('task' => 'list-item'));
        
        unset($this->_params['ssFilter']);
        $this->_params['paginator']['itemCountPerPage'] = 4;
        $this->_params['ssFilter']['order_by'] = 'id';
        $this->_params['ssFilter']['order'] = 'DESC';
        $this->_params['ssFilter']['filter_category'] = SERVICE_CATEGORY_ID;
        $services = $articleTableGateway->listItem($this->_params, array('task' => 'list-item'));
        
        unset($this->_params['ssFilter']);
        $this->_params['paginator']['itemCountPerPage'] = 20;
        $this->_params['ssFilter']['order_by'] = 'id';
        $this->_params['ssFilter']['order'] = 'DESC';
        $banners = $bannerTableGateway->listItem($this->_params, array('task' => 'list-item'));
        
        return new ViewModel(array(
            'featuredProducts' => $featuredProducts,
            'services' => $services,
            'banners' => $banners,
        ));
    }
    
    public function contactAction()
    {
        if ($this->getRequest()->isPost()) {
            // $mail = new Mail\Message();
            // $mail->setBody('This is the text of the email.');
            // $mail->setFrom('Freeaqingme@example.org', 'Sender\'s name');
            // $mail->addTo('hoangphuocthanhtrung@gmail.com', 'Name of recipient');
            // $mail->setSubject('TestSubject');

            // $transport = new Mail\Transport\Sendmail();
            // $result = $transport->send($mail);

            $to      = 'pvhuyhoang166@gmail.com';
            $subject = 'the subject';
            $message = 'hello';
            $headers = 'From: webmaster@example.com' . "\r\n" .
                'Reply-To: webmaster@example.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

            mail($to, $subject, $message, $headers);
        }
        //set Head info
        $this->_viewHelper->get('HeadTitle')->prepend(TITLE_CONTACT . ' - ' . $this->_configs->title);
        $this->_viewHelper->get('HeadMeta')->setName('keywords', $this->_configs->keywords);
        $this->_viewHelper->get('HeadMeta')->setName('description', $this->_configs->description);
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

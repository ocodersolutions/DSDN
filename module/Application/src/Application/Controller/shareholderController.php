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

class shareholderController extends OcoderBaseController
{
    public function init() {
        
    }
    
    public function indexAction()
    {
        return new ViewModel(array());
    }
}
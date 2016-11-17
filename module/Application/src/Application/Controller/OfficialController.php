<?php

namespace Application\Controller;

use Zend\View\Model\ViewModel;
use Ocoder\Base\BaseActionController as OcoderBaseController;
use Ocoder\Paginator\Paginator as OcoderPaginator;
use Zend\Session\Container;

class OfficialController extends OcoderBaseController {
	 public function indexAction() {
	 	return new ViewModel();
	 }

}
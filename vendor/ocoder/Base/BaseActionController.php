<?php

namespace Ocoder\Base;

use Zend\Mvc\MvcEvent;
use Zend\Mvc\Controller\PluginManager;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\Container;

class BaseActionController extends AbstractActionController {

    protected $_tableGateway;
    protected $_authService;
    protected $_formObj;
    protected $_params;
    protected $_options = array('modelTable' => '', 'formName' => '');
    protected $_paginator = array(
        'itemCountPerPage' => ROWS_PER_PAGE,
        'pageRange' => PAGE_RANGE,
    );
    protected $_viewHelper;
    protected $_configs;

    public function setPluginManager(PluginManager $plugins) {
        // attach onInit function into Event Manager
        // 100 - set high priority for Init function (will load before controller)
        $this->getEventManager()->attach(MvcEvent::EVENT_DISPATCH, array($this, 'onInit'), 100);
        parent::setPluginManager($plugins);
    }

    public function onInit(MvcEvent $e) {
        $ssSystem = new Container('system');
        
        // GET MODULE - CONTROLLER - ACTION
        $routeMatch = $e->getRouteMatch();
        $controllerArray = explode('\\', $routeMatch->getParam('controller'));

        // SET MODULE - CONTROLLER - ACTION FOR $_PARAMS
        $this->_params['module'] = strtolower($controllerArray[0]);
        $this->_params['controller'] = strtolower($controllerArray[2]);
        $this->_params['action'] = $routeMatch->getParam('action');

        // SET MODULE - CONTROLLER - ACTION FOR VIEW
        $viewModel = $e->getApplication()->getMvcEvent()->getViewModel();
        $viewModel->module = $this->_params['module'];
        $viewModel->controller = $this->_params['controller'];
        $viewModel->action = $this->_params['action'];

        // SET LAYOUT
        $config = $this->getServiceLocator()->get('config');
        $this->layout($config['module_layouts'][$controllerArray[0]]);
        // $this->layout('layout/frontend');

        $this->_viewHelper = $this->getServiceLocator()->get('ViewHelperManager');
        $this->_configs = $ssSystem->configs;
        
        $this->init();
    }

    public function init() {
        // function for controller override
    }

    /**
     * Get Authentication Service
     */
    public function getAuthService() {
        if (!$this->_authService) {
            $this->_authService = $this->getServiceLocator()->get('AuthService');
        }
        return $this->_authService;
    }

    public function getTable() {
        if (empty($this->_tableGateway)) {
            $this->_tableGateway = $this->getServiceLocator()->get($this->_options['modelTable']);
        }
        return $this->_tableGateway;
    }

    public function getForm() {
        if (empty($this->_formObj)) {
            $this->_formObj = $this->getServiceLocator()->get('FormElementManager')->get($this->_options['formName']);
        }
        return $this->_formObj;
    }

    public function goAction($routerName, $actionInfo = null) {
        $actionInfo['controller'] = !empty($actionInfo['controller']) ? $actionInfo['controller'] : $this->_params['controller'];
        $actionInfo['action'] = !empty($actionInfo['action']) ? $actionInfo['action'] : 'index';
        $actionInfo['id'] = !empty($actionInfo['id']) ? $actionInfo['id'] : null;
        return $this->redirect()->toRoute($routerName . '/default', array(
                    'controller' => $actionInfo['controller'],
                    'action' => $actionInfo['action'],
                    'id' => $actionInfo['id'],
        ));
    }

}
